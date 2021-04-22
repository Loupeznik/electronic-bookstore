@if ($buttonType == 'listing')
    <button class="bg-white rounded-full border-2 border-transparent text-blue-800 hover:border-blue-800 transform-all duration-300 text-xs font-bold px-3 py-2 leading-none flex items-center" title="Add to cart" wire:click.prevent="addItem({{$bookId}})">
        <i class="ri-shopping-cart-line mr-2"></i>
        {{ $price }} {{ config('app.currency', null) }}
    </button>
@elseif ($buttonType == 'remove')
    <button class="bg-white rounded-full text-red-800 text-xs font-bold px-3 py-2 leading-none flex items-center" wire:click.prevent="removeItem({{$itemId}})">
        <i class="ri-delete-bin-2-line mr-2"></i> {{ __('Remove') }}
    </button>
@elseif ($buttonType == 'countPlus')
<button class="focus:outline-none bg-blue-300 hover:bg-blue-500 text-white font-bold py-1 px-1 rounded-full inline-flex items-center" wire:click.prevent="countPlus({{$itemId}})">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
  </button>
@elseif ($buttonType == 'countMinus')
<button class="focus:outline-none bg-blue-300 hover:bg-blue-500 text-white font-bold py-1 px-1 rounded-full inline-flex items-center" wire:click.prevent="countMinus({{$itemId}})">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
    </svg>
  </button>
@else
    <button wire:click.prevent="addItem({{$bookId}})"
        class="flex ml-auto text-gray-800 bg-blue-300 border-2 border-transparent py-2 px-6 focus:outline-none transition-colors duration-300 hover:border-blue-800 hover:text-blue-800 rounded">
        <i class="ri-shopping-cart-line mr-2"></i> {{ __('Add to cart') }}
    </button>
@endif
