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
            <x-section-header>
                Books
            </x-section-header>
            <div class="text-center">
                <form method="GET" action="/books">
                    <input class="w-3/4 h-16 rounded mb-8 focus:outline-none focus:shadow-outline text-xl px-8 shadow-lg"
                        type="search" name="book" placeholder="{{ __('Search by book name or ISBN') }}">
                    <input type="submit"
                        class="h-16 rounded mb-8 border-2 border-transparent bg-blue-300 font-semibold text-gray-800 hover:border-blue-800 ml-2 cursor-pointer hover:outline-none hover:shadow-outline  text-xl px-8 shadow-lg"
                        value="{{ __('Search') }}">
                </form>
            </div>
            <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 items-center">
                @forelse($books as $book)
                    <x-front-book-card :book="$book" />
                @empty
                    {{ __('No available listings') }}
                @endforelse
            </div>
            <div class="w-1/2 mx-auto items-center mb-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
