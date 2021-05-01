@props(['book'])

<div class="flex-shrink-0 mx-2 my-2 relative overflow-hidden bg-blue-300 rounded-lg max-w-md shadow-lg">
    <div class="mr-0">
    </div>
    <div class="relative pt-10 px-10 flex items-center justify-center">
        <a href="/books/detail/{{$book->id}}">
            <img class="relative w-40 border-2 border-transparent rounded-lg hover:border-blue-800 transform-all duration-300" src="/storage/{{$book->photo_path ?? config('filesystems.cover_photo_placeholder_path')}}" alt="book" />
        </a>
    </div>
    <div class="relative px-6 pb-6 mt-6 text-gray-800">
        <span class="block opacity-75 -mb-1">
            <x-hoverable-link link="{{'/category/' . $book->category->id}}"><i class="ri-book-mark-line mr-1"></i> {{$book->category->name}}</x-hoverable-link>
        </span>
        <div class="flex justify-between">
            <span class="block font-semibold text-xl">
                {{$book->name}}
            </span>
            <livewire:add-to-cart :buttonType="'listing'" :price="$book->sale_price ?? $book->price" :bookId="$book->id" />
        </div>
        <span class="block opacity-75 text-sm -mb-1">
            {{ __('by') }} <x-hoverable-link link="{{'/authors/detail/' . $book->author->id}}">{{$book->author->name . ' ' . $book->author->surname}}</x-hoverable-link>
        </span>
    </div>
</div>
