<?php

namespace App\Http\Controllers;

class CartController extends Controller
{
    public function __invoke()
    {
        return view('cart');
    }
}
