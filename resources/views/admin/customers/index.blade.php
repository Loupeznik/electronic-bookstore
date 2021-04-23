<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of customers') }}
            </x-section-header>

            @if (session('status'))
                <x-alert :dismissable="true" :status="session('status')" :message="session('message')" />
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Name', 'Surname', 'Has account', 'Orders', 'Shipping Methods', 'Actions']">
                    @forelse ($customers as $customer)
                        <x-table-row
                            :row="[$customer->name, $customer->surname, $customer->user ? 'Yes' : 'No',  $customer->orders_count, $customer->payment_methods_count]"
                            :actions="['edit', 'show']" :id="$customer->id" />
                    @empty
                        <x-table-row :row="['-','-','-','-','-','-']" />
                    @endforelse
                </x-table>
            </div>
            <div class="mt-3 w-1/2 mx-auto">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
