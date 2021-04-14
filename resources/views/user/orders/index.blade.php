<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth::user()->hasCustomer())
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('My orders') }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Items', 'Order date', 'Status', 'Total', 'Action']">
                    @forelse($orders as $order)
                        <x-table-row
                            :row="[$order->id, $order->items->count(), date('d.m.Y h:i', strtotime($order->created_at)), $order->status, $order->orderTotal('Kč')]"
                            :actions="['show', 'refund']" :id="$order->id"
                             />
                    @empty
                        <x-table-row :row["'-', '-', '-', '-', '-', '-'"] />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
    @else
        <x-alert>No customer account is tied to this user</x-alert>
    @endif
</x-app-layout>
