@props(['link', 'header'])

<li class="border-gray-400 flex flex-row mb-2">
    <div class="shadow border select-none bg-white rounded-md flex flex-1 items-center p-1">
        <div class="flex-1 pl-1">
            <div class="font-medium">
                <a href="{{ $link }}">{{ $header }}</a>
            </div>
            <div class="text-gray-600 text-sm">
                {{ $slot }}
            </div>
        </div>
    </div>
</li>
