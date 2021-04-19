<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('My details') }}
            </x-section-header>
            <div class="mx-auto my-2 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="p-4 text-center w-full">
                        <h1 class="font-semibold text-xl">User details</h1>
                        <div class="border-t mt-2">
                            <dl>
                                <x-book-detail-field :name="'Username'" :value="$user->name" />
                                <x-book-detail-field :name="'Email'" :value="$user->email" />
                                <x-book-detail-field :name="'Registered'"
                                    :value="date('d.m.Y h:i', strtotime($user->created_at))" />
                                <x-book-detail-field :name="'Role'" :value="$user->parseRole()" />
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            @if ($user->hasCustomer())
                <div class="mx-auto my-2 bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="md:flex">
                        <div class="p-4 text-center w-full">
                            <h1 class="font-semibold text-xl">Customer details</h1>
                            <div class="border-t mt-2">
                                <dl>
                                    <x-book-detail-field :name="'Street Address'"
                                        :value="$user->customer->street . ' ' . $user->customer->street_nr" />
                                    <x-book-detail-field :name="'City'"
                                        :value="$user->customer->zip . ' ' . $user->customer->city" />
                                    <x-book-detail-field :name="'Country'" :value="$user->customer->country" />
                                    <x-book-detail-field :name="'Phone number'" :value="$user->customer->phone" />
                                    <x-book-detail-field :name="'Order count'"
                                        :value="$user->customer->orders->count()" />
                                    <x-book-detail-field :name="'Payment method count'"
                                        :value="$user->customer->paymentMethods->count()" />
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($user->hasCustomer())
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('My latest orders') }}
            </x-section-header>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Items', 'Order date', 'Status', 'Total', 'Action']">
                    @forelse($user->customer->orders as $order)
                        <x-table-row
                            :row="[$order->id, $order->items->count(), date('d.m.Y h:i', strtotime($order->created_at)), $order->status(), $order->orderTotal('Kč')]" 
                            :actions="['show']" :id="$order->id" :path="'user/orders'"
                            />
                    @empty
                        <x-table-row :row="['-', '-', '-', '-', '-']" />
                    @endforelse
                </x-table>
            </div>
            <div class="mt-2 text-center">
            <a href="/user/orders"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-md text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Show all orders') }}
            </a>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
