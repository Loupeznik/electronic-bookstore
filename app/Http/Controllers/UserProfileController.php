<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderReturn;


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
        $user = Auth::user();

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
        if (Auth::user()->hasCustomer())
        {
            $orders = Order::where('customer_id', Auth::user()->customer->id)->get();
            return view('user.orders.index', compact('orders'));
        }
        else return view('user.orders.index');
    }

    /**
     * Show user's orders.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function order(Order $order)
    {
        if ($order->customer_id != Auth::user()->customer->id)
        {
            return redirect('/user/orders')->with('status', 'error')->with('message', 'You may create a refund request only for you own orders');
        }

        return view('user.orders.detail', compact('order'));
    }

    /**
     * Show refund request form.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function refund(Order $order)
    {
        if ($order->customer_id != Auth::user()->customer->id)
        {
            return redirect('/user/orders')->with('status', 'error')->with('message', 'You may create a refund request only for you own orders');
        }

        return view('user.orders.refund', compact('order'));
    }

    /**
     * Show user's orders.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function refundStore(Request $request, Order $order)
    {
        if ($order->customer_id != Auth::user()->customer->id)
        {
            return redirect('/user/orders')->with('status', 'error')->with('message', 'You may create a refund request only for you own orders');
        }
        else if ($order->hasReturn())
        {
            return redirect('/user/orders')->with('status', 'error')->with('message', 'This order already has a refund request');
        }
        else
        {
            $request->validate([
                'description' => ['required', 'min: 30', 'max: 500']
            ]);
    
            $return = OrderReturn::create([
                'description' => $request->description,
                'order_id' => $order->id
            ]);
    
            $order->update([
                'status' => 4
            ]);
    
            return redirect('/user/orders')->with('status', 'success')->with('message', 'Return request ' . $return->id . ' has been stored for further processing');
        }
    }
}
