@props(['order'])

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-section-header>
            {{ __('Order details') }}
        </x-section-header>
        <div class="mx-auto my-2 bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex">
                <div class="p-4 text-center w-full">
                    <h1 class="font-semibold text-xl">Order id: {{ $order->id }}</h1>
                    <div class="border-t mt-2">
                        <dl>
                            <x-book-detail-field :name="'Order created'" :value="date('d.m.Y h:i', strtotime($order->created_at))" />
                            <x-book-detail-field :name="'Sum'" :value="$order->sum . ' Kč'" />
                            <x-book-detail-field :name="'VAT'" :value="$order->vat . ' Kč'" />
                            <x-book-detail-field :name="'Total'" :value="$order->orderTotal('Kč')" />
                            <x-book-detail-field :name="'Status'" :value="$order->status()" />
                            <x-book-detail-field :name="'Shipping method'" :value="$order->shippingMethod->name" />
                                <x-book-detail-field :name="'Shipping cost'" :value="$order->shippingMethod->cost . ' Kč'" />
                            <x-book-detail-field :name="'Payment method'" :value="$order->paymentMethod->type" />
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-section-header>
            {{ __('Order items') }}
        </x-section-header>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-table :columns="['Book', 'Count', 'Unit price', 'Total']">
                @forelse($order->items as $item)
                    <x-table-row
                        :row="[$item->book->name, $item->count, $item->unit_price . ' Kč', $item->count * $item->unit_price . ' Kč']" />
                @empty
                    <x-table-row :row="['-', '-' , '-' , '-']" />
                @endforelse
            </x-table>
        </div>
    </div>
</div>
