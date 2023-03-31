<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'movie/popular?language='.App::getLocale())
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'movie/now_playing?language='.App::getLocale())
            ->json()['results'];


        $genres = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'genre/movie/list?language='.App::getLocale())
            ->json()['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies, $nowPlayingMovies, $genres
        );

        return view('movies.index', $viewModel);
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
            ->get(config('services.tmdb.url')."movie/$id?language=".App::getLocale()."&append_to_response=credits,videos,images")
            ->json();

        $images = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url')."movie/$id/images")
            ->json();

        $videos = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url')."movie/$id/videos")
            ->json();

        $viewModel = new MovieViewModel($movie, $images, $videos);

        return view('movies.show', $viewModel);
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

}
