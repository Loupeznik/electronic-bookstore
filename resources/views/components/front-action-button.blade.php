@props(['link'])
<a href="{{ $link }}"
    class="flex ml-auto text-gray-800 bg-blue-300 border-2 border-transparent py-2 px-6 focus:outline-none transition-colors duration-300 hover:border-blue-800 hover:text-blue-800 rounded">
    {{ $slot }}
</a>
