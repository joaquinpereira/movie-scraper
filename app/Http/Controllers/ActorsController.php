<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $page = 1)
    {
        abort_if($page > getTotalPages($request,'pagesPopularActors'), 204);

        $results = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.url').'person/popular?page='.$page)
            ->json();

        $popularActors =$results['results'];
        setTotalPages($request,'pagesPopularActors', $results['total_pages']);

        $viewModel = new ActorsViewModel($popularActors, $page, $results['total_pages']);

        return view('actors.index', $viewModel);
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
        // // $viewModel = new ActorsViewModel($popularActors, $page, $results['total_pages']);

        // return view('actors.show', $viewModel);
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
