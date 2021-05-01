<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('Author detail') }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-1">
                <x-table :columns="['Surname', 'Name', 'Country', 'Birthdate', 'Books']">
                    <x-table-row :row="[$author->surname, $author->name, $author->nationality, $author->birthdate, $author->books->count()]" />
                </x-table>
            </div>
            <x-section-header>
                {{ __('Author\'s books') }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Name', 'In stock', 'Price', 'Category']">
                    @forelse($author->books as $book)
                        <x-table-row :row="[$book->name, $book->available, $book->sale_price ?? $book->price, $book->category->name]" />
                    @empty
                        <x-table-row :row="['-','-','-','-']" />
                    @endforelse
                    </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
