@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{$actor['profile_path']}}" alt="profile image" class="w-96 border-8 border-gray-200 rounded-lg">
                <ul class="flex justify-center mt-4 w-full">
                    @if ($social['facebook'])
                        <li>
                            <a href="{{$social['facebook']}}" title="Facebook" target="blank">
                                <i class="fa-brands fa-square-facebook text-4xl fill-current text-gray-400 hover:text-white w-12"></i>
                            </a>
                        </li>
                    @endif
                    @if ($social['instagram'])
                        <li>
                            <a href="{{$social['instagram']}}" title="Instagram" target="blank">
                                <i class="fa-brands fa-instagram text-4xl fill-current text-gray-400 hover:text-white w-12"></i>
                            </a>
                        </li>
                    @endif
                    @if ($social['twitter'])
                        <li>
                            <a href="{{$social['twitter']}}" title="Twitter" target="blank">
                                <i class="fa-brands fa-twitter text-4xl fill-current text-gray-400 hover:text-white w-12"></i>
                            </a>
                        </li>
                    @endif
                    @if ($actor['homepage'])
                        <li>
                            <a href="{{$actor['homepage']}}" title="Website">
                                <i class="fa-solid fa-earth-americas text-4xl fill-current text-gray-400 hover:text-white w-12"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$actor['name']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <i class="fa-solid fa-cake-candles"></i>
                    <span class="ml-2">{{$actor['birthday']}} ({{$actor['age']}} years old) in {{$actor['place_of_birth']}}</span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{$actor['biography']}}
                </p>

                <h4 class="font-semibold mt-12">Known For</h4>

                <div class="grid grid-cols-8 sm:grid-cols-5 lg:grid-cols-5 gap-8">
                    @foreach($knownForTitles as $title)
                        <div class="mt-4">
                            <a href="{{$title['title_path']}}">
                                <img src="{{$title['poster_path']}}"
                                    alt="poster" class=" hover:opacity-75 transition ease-in-out duration-200">
                            </a>
                            <a href="{{$title['title_path']}}" class=" text-sm leading-normal block text-gray-400 hover:text-white mt-1">
                                {{$title['title']}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="credits t border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach ($credits as $credit)
                    <li>{{$credit['release_year']}} &middot; <strong>{{$credit['title']}}</strong> as {{$credit['character']}} - {{$credit['media_type']}}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
