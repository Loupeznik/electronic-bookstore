<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of books') }}
            </x-section-header>

            @if (session('status'))
                <x-alert :dismissable="true" :status="session('status')" :message="session('message')" />
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Name', 'ISBN', 'Price', 'Qty Available',  'Category', 'Last update', 'Actions']">
                    @forelse ($books as $book)
                        <x-table-row
                            :row="[$book->name, $book->isbn, $book->sale_price ?? $book->price . config('app.currency', null), $book->available, $book->category->name, date('d.m.Y h:i', strtotime($book->updated_at))]"
                            :actions="['edit', 'show', 'delete']" :id="$book->id" />
                    @empty
                        <x-table-row :row="['-','-','-','-','-','-','-']" />
                    @endforelse
                </x-table>
            </div>
            <div class="mt-3 w-1/2 mx-auto">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
