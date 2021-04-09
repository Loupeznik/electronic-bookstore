@extends('books')
@section('listing')
    <x-section-header>
        {{ __('Book details') }}
    </x-section-header>
    <x-front-book-detail :book="$book" />
@endsection
