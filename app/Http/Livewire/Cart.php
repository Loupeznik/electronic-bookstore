<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;

class Cart extends Component
{
    public $cart;
    protected $listeners = ['removeItem' => '$refresh', 'qtyChange' => '$refresh'];

    public function mount()
    {
        $this->cart = CartModel::with('items')->where('session_id', session()->getId())->firstOrCreate(['session_id' => session()->getId()]);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
