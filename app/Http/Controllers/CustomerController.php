<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    use PasswordValidationRules;

    /**
     * Show a list of customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with(['user'])->withCount(['paymentMethods', 'orders'])->simplePaginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show a list of customers.
     *
     * @param \App\Http\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        return view('admin.customers.detail', compact('customer'));
    }

    /**
     * Show a form to edit a specific customer's information.
     *
     * @param \App\Http\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Show a form to edit a specific customer's information.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($this->validateInput($request));

        return redirect('/admin/customers')->with('status', 'success')->with('message', 'Customer ' . $customer->name . ' ' . $customer->surname . ' has been updated');
    }

    /**
     * Register a new user and tie this user to a previously created customer.
     * Works with OrderController which created the customer beforehand.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = session('order');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Customer::where('id', session('customer'))->update([
            'user_id' => $user->id
        ]);

        $request->session()->forget(['order', 'customer']);
        return redirect('/checkout/success')->with('order', $order);
    }

    private function validateInput($input) 
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
            'email' => ['nullable', 'email']
        ]);
    }
}
