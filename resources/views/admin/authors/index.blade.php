<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of authors') }}
            </x-section-header>

            @if (session('status'))
                <x-dismissable-alert>
                    {{ session('status') }}
                </x-dismissable-alert>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Surname', 'Name', 'Country', 'Birthdate', 'Books', 'Actions']">
                    @forelse ($authors as $author)
                        <x-table-row
                            :row="[$author->surname, $author->name, $author->nationality, $author->birthdate, $author->books_count]"
                            :actions="['edit', 'show']" :id="$author->id" />
                    @empty
                        <x-table-row :row="['-','-','-','-','-','-']" />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
