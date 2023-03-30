<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    protected $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path']
                    ? config('services.tmdb.url_imgs').'w500'.$this->tvshow['poster_path']
                    : 'https:/via.placeholder.com/185x278',
            'vote_average' => $this->tvshow['vote_average'] * 10 . '%',
            'first_air_date' => isset($this->tvshow['first_air_date']) ? Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y') : '',
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(4),
            'cast' => $this->formatCast($this->tvshow['credits']['cast']),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9),
            'trailers' => collect($this->getTrailers($this->tvshow['videos']['results']))->take(4)
        ])->dump();
    }

    private function getTrailers($videos){
        $list = [];
        foreach($videos as $video){
            if($video['site']=='YouTube' && $video['type'] =='Trailer' && $video['official']){
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
