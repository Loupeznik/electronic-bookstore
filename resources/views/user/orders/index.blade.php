<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-alert :dismissable="true" :status="session('status')" :message="session('message')" />
            </div>
        </div>
    @endif

    @if (Auth::user()->hasCustomer())
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('My orders') }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Items', 'Order date', 'Status', 'Total', 'Action']">
                    @forelse($orders as $order)
                    @if ($order->hasReturn())
                        <x-table-row
                            :row="[$order->id, $order->items->count(), date('d.m.Y h:i', strtotime($order->created_at)), $order->status(), $order->orderTotal('Kč')]"
                            :actions="['show']" :id="$order->id"
                             />
                    @else
                        <x-table-row
                            :row="[$order->id, $order->items->count(), date('d.m.Y h:i', strtotime($order->created_at)), $order->status(), $order->orderTotal('Kč')]"
                            :actions="['show', 'refund']" :id="$order->id"
                             />
                    @endif
                    @empty
                        <x-table-row :row="['-', '-', '-', '-', '-', '-']" />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
    @else
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-alert :dismissable="false" :status="'Error'" :message="'No customer account is tied to this user'" />
            </div>
        </div>
    @endif
</x-app-layout>
