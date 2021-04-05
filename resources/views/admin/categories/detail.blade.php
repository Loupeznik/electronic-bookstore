<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ $category->name }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Name', 'In Stock', 'Price', 'Action']">
                    @forelse($category->books as $book)
                        <x-table-row :row="[$book->name, $book->available, $book->sale_price ?? $book->price]" :actions="['show', 'edit']" :id="$book->id" :path="'books'" />
                    @empty
                        <x-table-row :row="['-','-','-','-']" />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
