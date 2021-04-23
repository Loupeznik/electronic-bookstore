<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-section-header>
            {{ __('Update book') }}
        </x-section-header>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @empty($authors)
                <x-alert :dismissable="false" :status="'Warning'" :message="'No authors were found'" />
            @endempty
            @empty($categories)
                <x-alert :dismissable="false" :status="'Warning'" :message="'No categories were found'" />
            @endempty
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/admin/books/{{$book->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{$book->id}}" name="id">
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" name="name" class="w-full" type="text"
                                        value="{{$book->name}}" required />
                                </div>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="author" :value="__('Author')" />
                                <x-input-select id="author" name="author_id" class="w-full" required>
                                    @forelse ($authors as $author)
                                        <option value="{{ $author->id }}" @if($author->id == $book->author->id) selected @endif>{{ $author->surname . ' ' . $author->name }}
                                        </option>
                                    @empty
                                        <option id="-">-</option>
                                    @endforelse
                                </x-input-select>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="category" :value="__('Category')" />
                                <x-input-select id="category" name="category_id" class="w-full" required>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $book->category->id) selected @endif>{{ $category->name }}</option>
                                    @empty
                                        <option id="-">-</option>
                                    @endforelse
                                </x-input-select>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="price" :value="__('Price')" />
                                <x-input id="price" name="price" class="w-full" type="text" pattern="^\d*(\.\d{0,2})?$"
                                    value="{{ $book->price }}" required />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="sale_price" :value="__('Sale price')" />
                                <x-input id="sale_price" name="sale_price" class="w-full" type="text"
                                    pattern="^\d*(\.\d{0,2})?$" value="{{ $book->sale_price }}" />
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="language" :value="__('Language')" />
                                <x-input-select id="language" name="language" class="w-full" required>
                                    <option value="cs" @if ($book->language == 'cs') selected @endif>{{ __('Czech') }}</option>
                                    <option value="sk" @if ($book->language == 'sk') selected @endif>{{ __('Slovak') }}</option>
                                    <option value="en" @if ($book->language == 'en') selected @endif>{{ __('English') }}</option>
                                    <option value="de" @if ($book->language == 'de') selected @endif>{{ __('German') }}</option>
                                </x-input-select>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="qty" :value="__('Available quantity')" />
                                <x-input id="qty" name="available" class="w-full" type="number"
                                    value="{{ $book->available }}" />
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="publisher" :value="__('Publisher')" />
                                <x-input id="publisher" name="publisher" class="w-full" type="text"
                                    value="{{ $book->publisher }}" />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="year" :value="__('Publish year')" />
                                <x-input id="year" name="year" class="w-full" type="number"
                                    value="{{ $book->year }}" />
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="isbn" :value="__('ISBN')" />
                                    <x-input id="isbn" name="isbn" type="text" class="w-full" value="{{$book->isbn}}" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="desc" :value="__('Description')" />
                                    <x-input-textarea name="description" class="w-full" id="desc">{{$book->description}}</x-input-textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="photo" :value="__('Cover photo')" />
                                    <x-input type="file" id="photo" name="photo" class="w-full" />
                                </div>
                            </div>
                        </div>
                        <x-button>{{ __('Update') }}</x-button>
                    </form>

                    @if ($errors->any())
                        <div class="rounded-lg p-2 mt-2 bg-yellow-100">
                            <x-input-error class="mb-4" :errors="$errors" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
