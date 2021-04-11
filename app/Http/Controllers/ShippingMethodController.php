<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = ShippingMethod::all();

        return view('admin.shipping.index', compact('methods'));
    }

    public function edit(ShippingMethod $shipping_method)
    {
        return view('admin.shipping.edit', compact(['method' => $shipping_method]));
    }

    public function update(Request $request, ShippingMethod $shipping_method)
    {
        $shipping_method->update($this->validateInput($request));

        return redirect('/admin/shipping-methods')->with('status', 'success')->with('message', 'Shipping method ' . $shipping_method->name . ' has been updated');
    }

    public function create()
    {
        return view('admin.shipping.create');
    }

    public function store(Request $request)
    {
        ShippingMethod::create($this->validateInput($request));

        return redirect('/admin/shipping-methods')->with('status', 'success')->with('message', 'Shipping method ' . $request->name . ' has been created');
    }

    public function destroy($id)
    {
        ShippingMethod::where('id', $id)->delete();

        return redirect('/admin/shipping-methods')->with('status', 'success')->with('message', 'Shipping method has been deleted');
    }

    private function validateInput($input) 
    {
        return $input->validate([
            'name' => ['required', 'string', 'min:2', 'max:30', 'unique:shipping_methods'],
            'cost' => ['required', 'numeric']
        ]);
    }
}
