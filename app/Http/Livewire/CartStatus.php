<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\Cart;

class CartStatus extends Component
{
    public $productCount = 0;
    protected $listeners = ['addItem' => 'render', 'removeItem' => 'render'];

    public function render()
    {
        $this->productCount = CartItem::where('cart_id', Cart::where('session_id', session()->getId())->firstOrCreate(['session_id' => session()->getId()])->id)->count();
        return view('livewire.cart-status');
    }
}
