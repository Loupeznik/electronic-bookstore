<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('Customer details') }}
            </x-section-header>
            <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="p-4 text-center w-full">
                        <h1 class="font-semibold text-xl">{{ __('Name') }}: {{ $customer->name . ' ' . $customer->surname }}</h1>
                        <div class="border-t mt-2">
                            <dl>
                                <x-book-detail-field :name="'Street Address'" :value="$customer->street . ' ' . $customer->street_nr" />
                                <x-book-detail-field :name="'City'" :value="$customer->zip . ' ' . $customer->city" />
                                    <x-book-detail-field :name="'Country'" :value="$customer->country" />
                                <x-book-detail-field :name="'Phone number'" :value="$customer->phone" />
                                @if ($customer->hasUser())
                                    <x-book-detail-field :name="'Is registered'" :value="'YES'" />
                                @else
                                    <x-book-detail-field :name="'Is registered'" :value="'NO'" />
                                @endif
                                <x-book-detail-field :name="'Email'" :value="$customer->user->email ?? $customer->email" />
                                <x-book-detail-field :name="'Order count'" :value="$customer->orders->count()" />
                                <x-book-detail-field :name="'Payment method count'" :value="$customer->paymentMethods->count()" />
                            </dl>
                        </div>
                        @if ($customer->hasUser())
                        <a href="/admin/users/{{$customer->user->id}}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Show user info for this customer') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <x-section-header>
                {{ __('Customer\'s orders') }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Status', 'Created at', 'Total', 'Action']">
                    @forelse($customer->orders as $order)
                        <x-table-row :row="[$order->id, $order->status(), date('d.m.Y h:i', strtotime($order->created_at)), $order->orderTotal('Kč')]" :actions="['show']" :id="$order->id" :path="'admin/orders'" />
                    @empty
                        <x-table-row :row="['-','-','-','-', '-']" />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
