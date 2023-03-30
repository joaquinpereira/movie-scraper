@extends('layouts.main')

@section('content')
tv show
    {{-- <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{$movie['poster_path']}}" alt="{{$movie['title']}}" class="w-96 border-8 border-gray-200 rounded-lg">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <i class="fa-sharp fa-solid fa-star text-orange-500"></i>
                    <span class="ml-1">{{$movie['vote_average']}}</span>
                    <span class="mx-2"> - </span>
                    <i class="fas fa-vote-yea text-orange-500"></i>
                    <span class="ml-1">{{$movie['vote_count']}} votes</span>
                    <span></span>
                    <span class="mx-2">|</span>
                    <span>{{$movie['release_date']}}</span>
                    <span class="mx-2">|</span>
                    <span>{{$movie['genres']}}</span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{$movie['overview']}}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Cast</h4>
                    <div class="flex mt-4">
                        @foreach ($movie['crew'] as $crew)
                                <div class="mr-8">
                                    <div>{{$crew['name']}}</div>
                                    <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                                </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12">
                    @if(count($movie['trailers'])>0)
                        <x-trailer-carousel :trailers="$movie['trailers']"/>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['cast'] as $cast)
                    @if(strlen($cast['profile_path'])>0)
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $cast['id'])}}">
                                <img src="{{config('services.tmdb.url_imgs').'w500'.$cast['profile_path']}}" alt="{{$cast['name']}}" class="hover:opacity-75 transition ease-in-out duration-200">
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('actors.show', $cast['id'])}}" class="text-lg mt-2 hover:text-gray-300 font-semibold text">{{$cast['name']}}</a>
                                <div class="flex items-center text-gray-400 text-sm mt-1">
                                    {{$cast['character']}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="movie-images" x-data="{ isOpen:false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['images'] as $image)
                    <div class="mt-8">
                        <a
                            href="#"
                            @click.prevent="
                                isOpen=true
                                image='{{config('services.tmdb.url_imgs').'original'.$image['file_path']}}'
                            ">
                            <img src="{{config('services.tmdb.url_imgs').'original'.$image['file_path']}}" alt="images" class="hover:opacity-75 transition ease-in-out duration-200">
                        </a>
                    </div>
                @endforeach
            </div>
            <div style="background-color: rgba(0, 0, 0, .5)"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                 x-show="isOpen">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click.prevent="isOpen=false"
                                @keydown.escape.window="isOpen=false"
                                class="text-3xl leading-none hover:text-gray-300" >&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" >
                                <img :src="image" alt="poster">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
