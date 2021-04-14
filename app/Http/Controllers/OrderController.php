<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a list of orders to an authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('customer_id', Auth::user()->customer->id)->get();

        return view('user.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shippingMethods = ShippingMethod::all();
        $cart = Cart::with('items')->where('session_id', session()->getId())->first();
        return view('checkout', compact(['shippingMethods', 'cart']));
    }

    /**
     * Create an order and other connected models.
     * Works with CustomerController for a 2-step customer creation and registration
     * if the user decides to register for an account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate shipping and payment info
        $this->validateAdditionalInfo($request);

        // Get the customer's cart
        $cart = Cart::with('items')->where('session_id', session()->getId())->first();

        // Register a new customer or use an old one with the inserted customer info
        $customer = Customer::firstOrCreate($this->validateCustomerInfo($request));

        // Create a new order
        $order = Order::create([
            'cart_id' => $cart->id,
            'sum' => $cart->overallSum(),
            'vat' => number_format($cart->overallSum() * .21, 2),
            'status' => 0,
            'payment_method_id' => PaymentMethod::firstOrCreate([
                'customer_id' => $customer->id,
                'type' => $request->payment_method
            ])->id,
            'shipping_id' => $request->shipping_method,
            'customer_id' => $customer->id
        ]);

        // Create items of selected order and delete items belonging to the customer's cart
        foreach ($cart->items as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book->id,
                'count' => $item->count,
                'unit_price' => $item->book->price
            ]);
            $item->delete();
        }

        // Delete the customer's cart
        $cart->delete();

        // Check if registration checkbox is checked
        // If so, the system redirects the user to customer registration page
        // The second step of this registration process is completed in CustomerController
        if ($request->has('register'))
        {
            session(['order' => $order]);
            session(['customer' => $customer->id]);
            return redirect('/register');
        }

        // Redirect customer to a bogus payment gate (it then redirects him to a success page)
        // return redirect('/checkout/payment')->with('customer', $customer)->with('order', $order);

        // Redirect customer to the success page directly
        return redirect('/checkout/success')->with('order', $order);
    }

    /**
     * Show a success page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        // Show success page after an order has been created, otherwise abort
        if ($request->session()->has('order'))
        {
            return view('order-creation-status');
        }
        else
        {
            return abort(401);
        }
    }

    /**
     * Display an order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // TODO
    }

    /**
     * Delete an order. This action can only be done by an admin.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect('/admin/orders')->with('status', 'success')->with('message', 'Order has been deleted');
    }

    private function validateCustomerInfo($input) 
    {
        if ($input->has('register'))
        {
            return $input->validate([
                'name' => ['required', 'string', 'max: 100'],
                'surname' => ['required', 'string', 'max: 100'],
                'street' => ['required', 'string', 'min:5', 'max:100'],
                'street_nr' => ['required', 'numeric', 'digits_between:1,4'],
                'city' => ['required', 'string', 'max: 100'],
                'zip' => ['required', 'numeric', 'digits:5'],
                'country' => ['required', 'string', Rule::in(['cz', 'sk'])],
                'phone' => ['required', 'regex:/^\d{9}$/'],
                'email' => ['required', 'email']
            ]);
        }
        return $input->validate([
            'name' => ['required', 'string', 'max: 100'],
            'surname' => ['required', 'string', 'max: 100'],
            'street' => ['required', 'string', 'min:5', 'max:100'],
            'street_nr' => ['required', 'numeric', 'digits_between:1,4'],
            'city' => ['required', 'string', 'max: 100'],
            'zip' => ['required', 'numeric', 'digits:5'],
            'country' => ['required', 'string', Rule::in(['cz', 'sk'])],
            'phone' => ['required', 'regex:/^\d{9}$/']
        ]);
    }

    private function validateAdditionalInfo($input) 
    {
        return $input->validate([
            'shipping_method' => ['required', 'numeric'],
            'payment_method' => ['required', Rule::in(['PayPal', 'VISA', 'Mastercard', 'bank'])]
        ]);
    }
}
