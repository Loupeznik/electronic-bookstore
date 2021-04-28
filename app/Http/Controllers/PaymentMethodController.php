<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        try {
            $methods = PaymentMethod::where('customer_id', Auth::user()->customer->id)->get();
        }
        catch(\Exception $e)
        {
            return view('user.methods.index');
        }

        return view('user.methods.index', compact('methods'));
    }

    public function create()
    {
        return view('user.methods.create');
    }

    public function store(Request $request)
    {
        $this->validateInput($request);
        $method = PaymentMethod::create(['type' => $request->type, 'customer_id' => Auth::user()->customer->id]);

        return redirect('/user/methods')->with('status', 'success')->with('message', 'Payment method ' . $method->type . ' has been created');
    }

    public function edit(PaymentMethod $method)
    {
        if ($this->authorized($method))
        {
            return view('user.methods.edit', compact('method'));
        }
        else
        {
            return abort(401);
        }
    }

    public function update(Request $request, PaymentMethod $method)
    {
        if ($this->authorized($method))
        {
            $method->update($this->validateInput($request));

            return redirect('/user/methods')->with('status', 'success')->with('message', 'Payment method ' . $method->type . ' has been updated');
        }
        else
        {
            return abort(401);
        }
    }

    public function destroy(PaymentMethod $method)
    {
        if ($this->authorized($method))
        {
            $method->delete();

            return redirect('/user/methods')->with('status', 'success')->with('message', 'Payment method ' . $method->type . ' has been deleted');
        }
        else
        {
            return abort(401);
        }
    }

    public function authorized(PaymentMethod $method)
    {
        if (Auth::user()->customer->id == $method->customer->id)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validateInput($input)
    {
        return $input->validate([
            'type' => ['required', Rule::in(['PayPal', 'VISA', 'MasterCard', 'bank'])],
        ]);
    }
}
