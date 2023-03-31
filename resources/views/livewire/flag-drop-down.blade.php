<div class="relative mt-3 md:mt-0" x-data="{ open: false }">
    @php $locale = session()->get('locale'); @endphp
    <a href="#" @click="open = ! open" class="px-3 py-3 flex items-center">
        @switch($locale)
            @case('en')
            <img src="{{asset('img/flags/en.png')}}" width="25px"> English.
            @break
            @case('es')
            <img src="{{asset('img/flags/es.png')}}" width="25px"> Español.
            @break
            @default
            <img src="{{asset('img/flags/en.png')}}" width="25px"> English.
        @endswitch
        <span class="caret"></span>
    </a>

    <div class="absolute bg-gray-800 text-sm rounded-md w-64 mt-2 z-10"
        x-show.transition.opacity="open" @click.outside="open = false" style="display: none">
        <ul>
            <li>
                <a class="hover:bg-gray-700 px-3 py-3 flex items-center" href="/lang/en"><img src="{{asset('img/flags/en.png')}}" width="25px"> English</a>
            </li>
            <li>
                <a class="hover:bg-gray-700 px-3 py-3 flex items-center" href="/lang/es"><img src="{{asset('img/flags/es.png')}}" width="25px"> Español</a>
            </li>
        </ul>
    </div>
</div>
