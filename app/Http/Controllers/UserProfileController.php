<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class UserProfileController extends Controller
{
    /**
     * Show user profile.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->with('customer')->first();

        return view('user.dashboard', compact('user'));
    }

    /**
     * Show user's orders.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $orders = Order::where('customer_id', Auth::user()->customer->id)->get();

        return view('user.orders.index', compact('orders'));
    }

    /**
     * Show user's orders.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function order(Order $order)
    {
        $order = $order->with('items')->first();

        return view('user.orders.detail', compact('order'));
    }
}
