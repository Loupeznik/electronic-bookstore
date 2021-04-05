<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of categories') }}
            </x-section-header>

            @if (session('status'))
                <x-dismissable-alert>
                    {{ session('status') }}
                </x-dismissable-alert>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Name', 'Books', 'Actions']">
                    @forelse ($categories as $category)
                        <x-table-row
                            :row="[$category->name, $category->books_count]"
                            :actions="['edit', 'show']" :id="$category->id" />
                    @empty
                        <x-table-row :row="['-','-','-']" />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
