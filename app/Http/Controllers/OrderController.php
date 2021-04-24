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
use App\Models\User;

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
     * Show a form for creating a new order.
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

        // Check availability for each item
        foreach ($cart->items as $item)
        {
            if ($item->book->checkAvailability($item->count) == false)
            {
                //$item->delete();
                return redirect('/checkout')->with('status', 'error')->with('message', 'Item ' . $item->book->name . ' is not available in selected quantity');
            }
        }

        // Register a new customer or use an old one with the inserted customer info
        $customer = Customer::firstOrCreate($this->validateCustomerInfo($request));

        // Create a new order
        $order = Order::create([
            'cart_id' => $cart->id,
            'sum' => $cart->overallSum(),
            'vat' => number_format($cart->overallSum() * (config('app.vat_pct', 21) / 100), 2), // Calculate VAT as per config/app.php
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
            $item->book->update([
                'available' => $item->book->available - $item->count
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
     * Display paginated list of all pending orders. This action can only be done by an admin.
     * Displays all orders where status is not Finished or Cancelled
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $orders = Order::with(['items', 'customer', 'paymentMethod', 'shippingMethod'])->whereNotIn('status', [2,3])->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display an order. This action can only be done by an admin.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('user.orders.detail', compact('order'));
    }

    /**
     * Show a form for editing an existing order. This action can only be done by an admin.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $admins = User::where('role', 2)->get();

        return view('admin.orders.edit', compact(['admins', 'order']));
    }

    /**
     * Update an existing order. This action can only be done by an admin.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->validate([
            'assignee_id' => ['required', 'numeric', 'exists:\App\Models\User,id'],
            'status' => ['required', 'numeric', 'max:4']
        ]));

        return redirect('/admin/orders')->with('status', 'success')->with('message', 'Order updated');
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
