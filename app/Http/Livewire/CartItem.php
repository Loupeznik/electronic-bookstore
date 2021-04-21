<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    protected $listeners = ['qtyChange' => '$refresh'];

    public function render()
    {
        return view('livewire.cart-item');
    }
}
