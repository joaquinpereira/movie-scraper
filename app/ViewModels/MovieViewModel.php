<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public $images;

    protected $videos;

    public function __construct($movie, $images, $videos)
    {
        $this->movie = $movie;
        $this->images = $images;
        $this->videos = $videos;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path']
                    ? config('services.tmdb.url_imgs').'w500'.$this->movie['poster_path']
                    : 'https:/via.placeholder.com/500x750',
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => isset($this->movie['release_date']) ? Carbon::parse($this->movie['release_date'])->isoFormat(dateFormat()) : '',
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(4),
            'cast' => $this->formatCast($this->movie['credits']['cast']),
            'images' => collect($this->images['backdrops'])->take(9),
            'trailers' => collect($this->getTrailers($this->movie['videos']['results']))->take(4)
        ]);
    }

    private function getTrailers($videos){
        $list = [];
        if(collect($videos)->count() < 1){
            $videos = $this->videos['results'];
        }
        foreach($videos as $video){
            if($video['site']=='YouTube' && $video['type'] =='Trailer'){
                $list[] = $video;
            }
        }
        return $list;
    }

    private function formatCast($casts)
    {
        return collect($casts)->take(10)->map(function($cast){
            return collect($cast)->merge([
                'profile_path' => $cast['profile_path']
                    ? config('services.tmdb.url_imgs').'w500'.$cast['profile_path']
                    : 'https:/via.placeholder.com/500x750',
            ]);
        });
    }
}
