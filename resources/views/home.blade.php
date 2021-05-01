@extends('welcome')
@section('content')
<x-front-welcome-message />

<div class="px-1 py-1 mx-auto">
    <h3 class="text-2xl font-bold uppercase text-center">
        {{ __('Latest listings') }}
    </h3>
</div>

<div class="p-16">
    <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 items-center">
        @forelse($books as $book)
            <x-front-book-card :book="$book" />
        @empty
            <x-alert dismissable="false" :status="'Warning'" :message="'No available listings'" />
        @endforelse
    </div>
</div>

@endsection
