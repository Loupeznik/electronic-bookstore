@if ($buttonType == 'listing')
    <button class="bg-white rounded-full text-blue-800 text-xs font-bold px-3 py-2 leading-none flex items-center" title="Add to cart" wire:click.prevent="addItem({{$bookId}})">
        <i class="ri-price-tag-3-line mr-2"></i>
        {{ $price }} Kč
    </button>
@elseif ($buttonType == 'remove')
    <button class="bg-white rounded-full text-red-800 text-xs font-bold px-3 py-2 leading-none flex items-center" wire:click.prevent="removeItem({{$itemId}})">
        <i class="ri-delete-bin-2-line mr-2"></i> {{ __('Remove') }}
    </button>
@else
    <button wire:click.prevent="addItem({{$bookId}})"
        class="flex ml-auto text-gray-800 bg-blue-300 border-2 border-transparent py-2 px-6 focus:outline-none transition-colors duration-300 hover:border-blue-800 hover:text-blue-800 rounded">
        <i class="ri-shopping-cart-line mr-2"></i> {{ __('Add to cart') }}
    </button>
@endif
