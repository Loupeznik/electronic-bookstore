<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Models\Cart;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if ($request->wantsJson())
        {
            return response()->json(['two_factor' => false]);
        }
        else
        {
            if ($request->session('cart_old_id'))
            {   
                Cart::where('id', $request->session('cart_old_id'))->update(
                    [
                        'session_id' => session()->getId()
                    ]
                );
            }
            return redirect()->intended(config('fortify.home'));
        }
    }
}
