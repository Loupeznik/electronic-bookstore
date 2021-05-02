<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment methods') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('My payment methods') }}
            </x-section-header>

            @if (session('status'))
                <x-alert :dismissable="true" :status="session('status')" :message="session('message')" />
            @endif

            @if (Auth::user()->hasCustomer())
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-table :columns="['Name', 'Created at', 'Actions']">
                        @forelse ($methods as $method)
                            <x-table-row
                                :row="[$method->type, date('d.m.Y h:i', strtotime($method->created_at))]"
                                :actions="['edit', 'delete']" :id="$method->id" />
                        @empty
                            <x-table-row :row="['-','-','-']" />
                        @endforelse
                    </x-table>
                </div>
            @else
                <div class="py-4">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <x-alert :dismissable="false" :status="'Error'" :message="'No customer account is tied to this user'" />
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
