<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @unless(Auth::user()->isEditor())
                <div class="grid grid-cols-4 gap-2 m-2">
                    <div>
                        <h3 class="text-xl text-center mb-1">{{ __('Latest orders') }}</h3>
                        <x-dashboard-item-wrapper>
                            @forelse ($orders as $order)
                                <x-dashboard-item :link="'/admin/orders/' . $order->id" :header="'Order: ' . $order->id">
                                    {{ __('Customer') }}: {{ $order->customer->fullName() }}<br>
                                    {{ __('Created At') }}: {{ $order->created_at }}<br>
                                    {{ __('Total') }}: {{ $order->orderTotal() }}
                                </x-dashboard-item>
                            @empty
                                <p>{{ __('No pending orders found') }}</p>
                            @endforelse
                        </x-dashboard-item-wrapper>
                    </div>
                    <div>
                        <h3 class="text-xl text-center mb-1">{{ __('My assigned orders') }}</h3>
                        <x-dashboard-item-wrapper>
                            @forelse ($assignedOrders as $order)
                                <x-dashboard-item :link="'/admin/orders/' . $order->id" :header="'Order: ' . $order->id">
                                    {{ __('Customer') }}: {{ $order->customer->fullName() }}<br>
                                    {{ __('Created At') }}: {{ $order->created_at }}<br>
                                    {{ __('Total') }}: {{ $order->orderTotal() }}
                                </x-dashboard-item>
                            @empty
                                <p>{{ __('You haven\'t been assigned any orders') }}</p>
                            @endforelse
                        </x-dashboard-item-wrapper>
                    </div>
                    <div>
                        <h3 class="text-xl text-center mb-1">{{ __('My assigned returns') }}</h3>
                        <x-dashboard-item-wrapper>
                            @forelse ($assignedRefunds as $return)
                                <x-dashboard-item :link="'/admin/returns/' . $return->id" :header="'Return: ' . $order->id">
                                    {{ __('Customer') }}: {{ $return->order->customer->fullName() }}<br>
                                    {{ __('Created At') }}: {{ $return->created_at }}<br>
                                    {{ __('Status') }}: {{ $return->status() }}<br>
                                </x-dashboard-item>
                            @empty
                                <p>{{ __('You haven\'t been assigned any returns') }}</p>
                            @endforelse
                        </x-dashboard-item-wrapper>
                    </div>
                    <div>
                        <h3 class="text-xl text-center mb-1">{{ __('My assigned contact forms') }}</h3>
                        <x-dashboard-item-wrapper>
                            @forelse ($assignedConForms as $form)
                                <x-dashboard-item :link="'/admin/contact/' . $form->id" :header="'Form: ' . $form->id">
                                    {{ __('Sender') }}: {{ $form->name . ' ' . $form->email }}<br>
                                    {{ __('Created At') }}: {{ $form->created_at }}<br>
                                </x-dashboard-item>
                            @empty
                                <p>{{ __('You haven\'t been assigned any contact forms') }}</p>
                            @endforelse
                        </x-dashboard-item-wrapper>
                    </div>
                  </div>
                @endunless
                @if (session('status'))
                <div class="py-4">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <x-alert :dismissable="false" :status="session('status')" :message="session('message')" />
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
