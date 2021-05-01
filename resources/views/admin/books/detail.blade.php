<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('Book details') }}
            </x-section-header>
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        <img class="h-48 w-full object-cover md:w-48"
                            src="/storage/{{ $book->photo_path ?? config('filesystems.cover_photo_placeholder_path') }}"
                            alt="{{ $book->name }}">
                    </div>
                    <div class="p-4">
                        <h1 class="font-semibold text-xl">{{ $book->name }}</h1>
                        <p>{{ __('by') }} {{ $book->author->name . ' ' . $book->author->surname }}</p>
                        <div class="border-t mt-2">
                            <dl>
                                <x-book-detail-field :name="'Category'" :value="$book->category->name" />
                                <x-book-detail-field :name="'ISBN'" :value="$book->isbn" />
                                <x-book-detail-field :name="'Price'" :value="$book->price . ' ' . config('app.currency', null)" /> <!-- Parametrize by config's currency value -->
                                @isset($book->sale_price)
                                    <x-book-detail-field :name="'Sale price'" :value="$book->sale_price . ' ' . config('app.currency', null)" /> <!-- Parametrize by config's currency value -->
                                @else
                                    <x-book-detail-field :name="'Sale price'" :value="'Book is not on sale'" /> 
                                @endisset
                                <x-book-detail-field :name="'Language'" :value="$book->language" />
                                <x-book-detail-field :name="'Qty Available'" :value="$book->available" />
                                <x-book-detail-field :name="'Publisher'" :value="$book->publisher" />
                                <x-book-detail-field :name="'Published'" :value="$book->year" />
                                <x-book-detail-field :name="'Description'" :value="$book->description" />
                            </dl>
                        </div>
                    </div>
                    <a href="/admin/books/{{$book->id}}/edit" 
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
