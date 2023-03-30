<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;

    public $topRatedTv;

    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTvList($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTvList($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [ $genre['id'] => $genre['name'] ];
        });
    }

    private function formatTvList($tvList){
        return collect($tvList)->map(function($tv){
            return collect($tv)->merge([
                'poster_path' => $tv['poster_path']
                    ? config('services.tmdb.url_imgs').'w500'.$tv['poster_path']
                    : 'https:/via.placeholder.com/500x750',
                'vote_average' => $tv['vote_average'] * 10 . '%',
                'first_air_date' => isset($tv['first_air_date']) ? Carbon::parse($tv['first_air_date'])->format('M d, Y') : '',
                'genres' => $this->genresFormatted($tv['genre_ids'])
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }

    private function genresFormatted($genre_ids){
        return collect($genre_ids)->mapWithKeys(function($value){
            return [$value => $this->genres()->get($value)];
        })->implode(', ');
    }
}
