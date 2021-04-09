@extends('welcome')
@section('content')
    <x-section-header>
        {{ __('Author detail') }}
    </x-section-header>
    <div class="text-gray-700 body-font overflow-hidden">
        <div class="container px-5 py-10 mx-auto shadow border border-transparent rounded-lg">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-bold mb-1 uppercase">{{ $author->name . ' ' . $author->surname }}</h1>
                    <ul class="text-gray-900 my-2 py-1">
                        <li>{{ __('Date of birth') }}: {{ $author->birthdate ?? 'N/A' }}</li>
                        <li>{{ __('Nationality') }}: {{ $author->country ?? 'N/A' }} </li>
                        <li>{{ __('Number of books in store')}}: {{ $author->bookCount() }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <x-section-header>
        {{ __('Author\'s books') }}
    </x-section-header>
    <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 items-center mx-24">
    @forelse($author->books as $book)
        <x-front-book-card :book="$book" />
    @empty
        <p>No books for this author</p>
    @endforelse
    </div>
@endsection
