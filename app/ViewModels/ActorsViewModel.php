<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{

    public $popularActors;

    public $page;

    public $totalPages;

    public function __construct($popularActors, $page, $totalPages)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
        $this->totalPages = $totalPages;
    }

    public function popularActors()
    {
        return collect($this->popularActors)->map(function($actor){
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                ? config('services.tmdb.url_imgs').'w470_and_h470_face'.$actor['profile_path']
                : 'https://ui-avatars.com/api/?size=470&name='.$actor['name'],

                'known_for' => collect($actor['known_for'])->where('media_type','movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type','tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'name', 'id', 'profile_path', 'known_for'
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < $this->totalPages ? $this->page +1 : null;
    }
}
