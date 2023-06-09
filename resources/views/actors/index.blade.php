@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                @lang('Popular Actors')
            </h2>
            <div class="actors grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $actor['id'])}}">
                            <img src="{{$actor['profile_path']}}"
                                alt="profile image" class=" hover:opacity-75 ease-in-out duration-200">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $actor['id'])}}" class="text-lg hover:text-gray-300">{{$actor['name']}}</a>
                            <div class="text-sm truncate text-gray-400">{{$actor['known_for']}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{$previous}}">Previous</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a href="/actors/page/{{$next}}">Next</a>
            @else
                <div></div>
            @endif
        </div> --}}
        <div class="page-load-status">
            <div class="flex justify-center">
                <div class="infinite-scroll-request my-8 text-4xl">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </div>

            </div>
            <div class="flex justify-center">
                <p class="infinite-scroll-last my-8 text-4xl fa-beat">@lang('End of content')</p>
            </div>
            <p class="infinite-scroll-error">@lang('Error pagination')</p>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        window.addEventListener("load", function(event){
            let elem = document.querySelector('.actors');
            let infScroll = new InfiniteScroll( elem, {
                // options
                path: '/actors/page/@{{#}}',
                append: '.actor',
                status: '.page-load-status'
            });
        });
    </script>
@endsection
