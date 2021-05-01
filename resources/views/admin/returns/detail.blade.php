<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Refund requests') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('Refund request details') }}
            </x-section-header>
            <div class="mx-auto my-2 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="p-4 text-center w-full">
                        <h1 class="font-semibold text-xl">{{ __('Refund id') }}: {{ $refund->id }}</h1>
                        <div class="border-t mt-2">
                            <dl>
                                <x-book-detail-field :name="'Refund created'" :value="date('d.m.Y h:i', strtotime($refund->created_at))" />
                                <x-book-detail-field :name="'Order ID'" :value="$refund->order->id" />
                                <x-book-detail-field :name="'Status'" :value="$refund->status()" />
                                <x-book-detail-field :name="'Result'" :value="$refund->result() ?? '-'" />
                                <x-book-detail-field :name="'Assignee'" :value="$refund->assignee->name ?? '-'" />
                                <x-book-detail-field :name="'Completed'" :value="$refund->completed_at ?? 'No'" />
                                <x-book-detail-field :name="'Customer'" :value="$refund->order->customer->name . ' ' . $refund->order->customer->surname" />
                                <x-book-detail-field :name="'Customer email'" :value="$refund->order->customer->email ?? $refund->order->customer->user->email" />
                            </dl>
                        </div>
                        <a href="/admin/orders/{{$refund->order->id}}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Show the original order') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
