<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\CartItem;

class AddToCart extends Component
{

    public $buttonType; // Can be listing or detail, for book listings and book detail pages respectively
    public $price;
    public $bookId;
    public $cart;
    public $itemId;

    public function addItem($bookId)
    {
        $cart = CartModel::where('session_id', session()->getId())->firstOrCreate(['session_id' => session()->getId()]);
        CartItem::create([
            'cart_id' => $cart->id,
            'book_id' => $bookId,
            'count' => 1
        ]);
        $this->emit('addItem');
    }

    public function removeItem($itemId)
    {
        CartItem::find($itemId)->delete();
        $this->emit('removeItem');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
