@props(['name', 'value'])

<div class="bg-white px-1 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-semibold">
        {{$name}}
    </dt>
    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
        {{$value}}
    </dd>
</div>
