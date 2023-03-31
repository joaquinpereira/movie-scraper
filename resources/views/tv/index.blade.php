@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="now-playing-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-20">
                @lang('Top Rated Playing')
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"></x-tv-card>
                @endforeach
            </div>
        </div>
        <div class="popular-movies mt-20 border-t-2 pt-16">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                @lang('Popular Sows')
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"></x-tv-card>
                @endforeach
            </div>
        </div>
    </div>
@endsection
