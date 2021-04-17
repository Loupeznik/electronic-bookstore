<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->isAdmin() ? __('Admin dashboard') : __('User dashboard') }}
        </h2>
    </x-slot>

    @if ($order->hasReturn())
    <x-alert>
        {{ __('Refund request is in progress for this order') }} <!-- FORMATTING -->
    </x-alert>
    @endif

    <x-order-detail :order="$order" />

</x-app-layout>
