@props(['book'])

<div class="text-gray-700 body-font overflow-hidden">
    <div class="container px-5 py-10 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="book" class="lg:w-1/2 w-full object-cover object-center rounded border"
                src="/storage/{{ $book->photo_path ?? config('filesystems.cover_photo_placeholder_path') }}">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h1 class="text-gray-900 text-3xl title-font font-bold mb-1 uppercase">{{ $book->name }}</h1>
                <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ __('by') }}
                    <x-hoverable-link link="{{ '/authors/detail/' . $book->author->id }}">
                        {{ $book->author->name . ' ' . $book->author->surname }}</x-hoverable-link>
                </h2>
                <ul class="text-gray-900 my-2 py-1">
                    <li class="text-lg font-semibold">{{ __('Product details') }}</li>
                    <li>{{ __('Category') }}: 
                        <x-hoverable-link link="{{'/category/' . $book->category->id}}">{{ $book->category->name }}</x-hoverable-link>
                    </li>
                    <li>{{ __('ISBN') }}: {{ $book->isbn }}</li>
                    <li>{{ __('Publisher') }}: {{ $book->publisher ?? 'N/A' }}</li>
                    <li>{{ __('Published') }}: {{ $book->year }}</li>
                    <li>{{ __('Description') }}: <br> {{ $book->description }}</li>
                    <li class="font-bold uppercase text-lg my-2 text-black">{{ __('In stock') }}: {{ $book->available }}</li>
                </ul>
                @if ($book->sale_price)
                    <p class="text-gray-800 border-2 p-2 rounded border-red-400 bg-red-400 text-center w-max mb-2 font-bold uppercase">
                        <i class="ri-percent-line"></i> {{ __('On sale') }}
                    </p>
                @endif
                <div class="flex px-1">
                        <p class="title-font font-medium text-2xl text-gray-900">
                            {{  $book->sale_price ?? $book->price }} {{ config('app.currency', null) }}
                        </p>
                    <livewire:add-to-cart :bookId="$book->id" />
                </div>
            </div>
        </div>
    </div>
</div>
