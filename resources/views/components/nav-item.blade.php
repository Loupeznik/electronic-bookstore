@props(['link'])

<li class="flex">
    <a href="{{$link}}" class="flex items-center px-4 border-b-2 font-bold tracking-wide text-lg border-transparent hover:border-blue-700 uppercase text-gray-800 transition-all duration-300">
        {{$slot}}
    </a>
</li>
