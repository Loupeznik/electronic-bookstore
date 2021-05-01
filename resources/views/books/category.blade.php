@extends('books')
@section('listing')
    <x-section-header>
        {{ __('Books') }}
    </x-section-header>
    <p class="text-gray-800 p-2 text-center w-max mb-2 font-bold uppercase">
        <i class="ri-book-line"></i> {{ __('Books in category') }}: {{$books->total()}}
    </p>
    <p></p>
    <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 items-center">
        @forelse($books as $book)
            <x-front-book-card :book="$book" />
        @empty
            <x-alert dismissable="false" :status="'Warning'" :message="'No available listings'" />
        @endforelse
    </div>
    <div class="w-1/2 mx-auto items-center mb-4">
        {{ $books->links() }}
    </div>
@endsection
