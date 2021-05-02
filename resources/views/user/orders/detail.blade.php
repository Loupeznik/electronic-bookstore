<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    @if ($order->hasReturn())
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-alert :dismissable="false" :status="'Warning'" :message="'Refund request is in progress for this order'" />
            </div>
        </div>
    @endif

    <x-order-detail :order="$order" />

</x-app-layout>
