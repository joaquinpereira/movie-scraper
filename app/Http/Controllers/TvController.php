<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'tv/popular?language='.App::getLocale())
            ->json()['results'];

        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'tv/top_rated?language='.App::getLocale())
            ->json()['results'];


        $genres = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'genre/tv/list?language='.App::getLocale())
            ->json()['genres'];

        $viewModel = new TvViewModel(
            $popularTv, $topRatedTv, $genres
        );

        return view('tv.index', $viewModel);
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
        $tvshow = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url')."tv/$id?append_to_response=credits,videos,images")
            ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
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
