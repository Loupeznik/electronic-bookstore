<div>
    @forelse($cart->items as $item)
        <livewire:cart-item :item="$item" :key="$item->id" />
    @empty
        <p>{{ __('Your cart is empty') }}</p>
    @endforelse
</div>
