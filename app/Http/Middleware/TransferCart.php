<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferCart
{
    /**
     * Transfer customer's cart on login (if it exists).
     * This should update the cart's session key to the session
     * created on login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() && Cart::where('session_id', session()->getId())->exists())
        {
            $request->session()->put('cart_old_id', Cart::where('session_id', session()->getId())->first()->id);
        }
        return $next($request);
    }
}
