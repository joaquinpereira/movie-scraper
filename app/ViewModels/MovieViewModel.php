<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => config('services.tmdb.url_imgs').'w500'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => isset($this->movie['release_date']) ? Carbon::parse($this->movie['release_date'])->format('M d, Y') : '',
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(4),
            'cast' => collect($this->movie['credits']['cast'])->take(10),
            'images' => collect($this->movie['images']['backdrops'])->take(9),
            'trailers' => collect($this->getTrailers($this->movie['videos']['results']))->take(4)
        ]);
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
}
