@extends('welcome')
@section('content')
    <div class="grid grid-cols-8">
        <div class="col-span-1">
            <aside class="w-full p-6 h-auto sm:w-60">
                <nav class="space-y-8 text-sm">
                    <div class="space-y-2">
                        <h2 class="text-lg border-b border-gray-800 font-semibold tracking-widest uppercase text-gray-800">
                            {{ __('Categories') }}</h2>
                        <div class="flex flex-col space-y-1 text-base">
                            @forelse($categories as $category)
                                <x-hoverable-link link="{{ '/category/' . $category->id }}">{{ $category->name }}
                                </x-hoverable-link>
                            @empty
                                <p>{{ __('No categories found') }}</p>
                            @endforelse
                        </div>
                    </div>
                </nav>
            </aside>
        </div>
        <div class="col-span-7">
            @yield('listing')
        </div>
    </div>
@endsection
