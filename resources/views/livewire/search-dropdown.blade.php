<div class="relative mt-3 md:mt-0" x-data="{isOpen:true}" @click.away="isOpen = false">
    <input  wire:model.debounce.500ms="search"
            type="text"
            class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
            placeholder="Search (Press '/' to focus)"
            x-ref="search"
            @keydown.window="
                if(event.keyCode === 191 || event.keyCode === 111){
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
            @focus="isOpen = true"
            @keydown="isOpen = true"
            @keydown.escape.window="isOpen = false"
            @keydown.shift.tab="isOpen = false">

    <div class="absolute top-0">
        <i class="fa-solid fa-magnifying-glass w-4 text-gray-500 mt-2 ml-2"></i>
    </div>
    <span wire:loading class="inline-block animate-spin text-white text-sm top-0 right-0 mr-4 mt-3">
        <i class="fa-solid fa-arrows-spin"></i>
    </span>

    @if (strlen($search)>2)
        <div class="absolute bg-gray-800 text-sm rounded-md w-64 mt-2 z-10"
            x-show.transition.opacity="isOpen">
            @if($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $item)
                        <li class="{{$loop->last ? '': 'border-b border-gray-700'}}">
                            <a href="{{route('movies.show', $item['id'])}}"
                                class="hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if($loop->last) @keydown.tab="isOpen = false" @endif>
                                @if($item['poster_path'])
                                    <img src="{{$url_imgs.$item['poster_path']}}" alt="poster" class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                @endif
                                <span class="ml-4">{{$item['title']}}</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            @else
                <div class="px-3 py-3">No results for "{{$search}}"</div>
            @endif
        </div>
    @endif
</div>
