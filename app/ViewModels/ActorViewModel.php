<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;

    protected $social;

    protected $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
                ? config('services.tmdb.url_imgs').'w300'.$this->actor['profile_path']
                : 'https://ui-avatars.com/api/?size=470&name='.$this->actor['name']
        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id'] : null,
        ]);
    }

    public function knownForTitles()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take('5')
        ->map(function($cast){
            return collect($cast)->merge([
                'poster_path' => $cast['poster_path']
                    ? config('services.tmdb.url_imgs').'w185'.$cast['poster_path']
                    : 'https:/via.placeholder.com/185x278',
                'title' => isset($cast['title']) ? $cast['title'] : $cast['name'],
                'title_path' => isset($cast['title']) ? route('movies.show', $cast['id']) : route('tv.show', $cast['id'])
            ]);
        });
    }

    public function credits()
    {
        $credits = collect($this->credits)->get('cast');

        return collect($credits)->map(function($cast){

            $releaseDate = isset($cast['release_date'])
                ? $cast['release_date']
                : (isset($cast['name']) ? $cast['first_air_date'] : '');

            return collect($cast)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => isset($cast['title'])
                    ? $cast['title']
                    : (isset($cast['name']) ? $cast['name'] : 'Untitled'),
                'character' =>  isset($cast['character']) ? $cast['character'] : '',
                'media_type' => $cast['media_type'] == 'tv' ? Str::upper($cast['media_type']) : Str::ucfirst($cast['media_type']),
            ]);
        })->sortByDesc('release_date');
    }
}
