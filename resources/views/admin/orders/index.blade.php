<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of orders') }}
            </x-section-header>

            @if (session('status'))
                <x-dismissable-alert>
                    {{ session('status') }}
                </x-dismissable-alert>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Status', 'Assigned To', 'Total', 'Customer', 'Items', 'Created at', 'Actions']">
                    @forelse ($orders as $order)
                        <x-table-row
                            :row="[$order->id, $order->status(), $order->assignee->name ?? '-', $order->orderTotal('Kč'), $order->customer->fullName(), $order->items->count(), date('d.m.Y h:i', strtotime($order->created_at))]"
                            :actions="['show', 'edit', 'delete']" :id="$order->id" />
                    @empty
                        <x-table-row :row="['-','-','-','-','-','-', '-', '-']" />
                    @endforelse
                </x-table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
