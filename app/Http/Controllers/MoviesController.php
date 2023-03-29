<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Break_;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'movie/popular')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'movie/now_playing')
            ->json()['results'];


        $genres = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'genre/movie/list')
            ->json()['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies, $nowPlayingMovies, $genres
        );

        return view('index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url')."movie/$id?append_to_response=credits,videos,images")
            ->json();

        if(count($movie['videos']['results'])>4)
            $movie['videos']['results'] = $this->getTrailers($movie['videos']['results']);

        $viewModel = new MovieViewModel(
            $movie
        );

        return view('index', $viewModel);

        // return view('show',[
        //     'movie' => $movie,
        //     'poster' => config('services.tmdb.url_imgs').'w500',
        //     'url_imgs' => config('services.tmdb.url_imgs'),
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getTrailers($videos){
        $list = [];
        foreach($videos as $video){
            if($video['site']=='YouTube' && $video['type'] =='Trailer' && $video['official']){
                $list[] = $video;
            }
        }
        return $list;
    }
}
