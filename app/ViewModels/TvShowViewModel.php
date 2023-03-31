<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;

    public $images;

    protected $videos;

    public function __construct($tvshow, $images, $videos)
    {
        $this->tvshow = $tvshow;
        $this->images = $images;
        $this->videos = $videos;
    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path']
                    ? config('services.tmdb.url_imgs').'w500'.$this->tvshow['poster_path']
                    : 'https:/via.placeholder.com/185x278',
            'vote_average' => $this->tvshow['vote_average'] * 10 . '%',
            'first_air_date' => isset($this->tvshow['first_air_date']) ? Carbon::parse($this->tvshow['first_air_date'])->isoFormat(dateFormat()) : '',
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(4),
            'cast' => $this->formatCast($this->tvshow['credits']['cast']),
            'images' => collect($this->images['backdrops'])->take(9),
            'trailers' => collect($this->getTrailers($this->tvshow['videos']['results']))->take(4)
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
