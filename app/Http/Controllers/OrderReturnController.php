<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderReturn;
use App\Models\User;

class OrderReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returns = OrderReturn::with('order', 'assignee')->get();

        return view('admin.returns.index', compact('returns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = User::where('role', 2)->get();

        return view('admin.returns.create', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $refund = OrderReturn::create($this->validateInput($request));
        $this->updateOrder($refund->order, $request->status);

        return redirect('/admin/refunds')->with('status', 'success')->with('message', 'Order return successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function show(OrderReturn $refund)
    {
        return view('admin.returns.detail', compact('refund'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderReturn $refund)
    {
        $admins = User::where('role', 2)->get();

        return view('admin.returns.edit', compact(['refund', 'admins']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderReturn $refund)
    {
        dd($this->validateInput($request));
        $refund->update($this->validateInput($request));
        $this->updateOrder($refund->order, $request->status);

        return redirect('/admin/refunds')->with('status', 'success')->with('message', 'xxx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderReturn $refund)
    {
        //
    }

    public function validateInput($input)
    {
        return $input->validate([
            'order_id' => ['required', 'exists:\App\Models\Order,id'],
            'assignee_id' => ['required', 'numeric', 'exists:\App\Models\User,id'],
            'description' => ['required', 'min:30', 'max:500'],
            'status' => ['required', 'numeric', 'max:2'],
            'result' => ['nullable'],
            'completed_at' => ['nullable', 'date']
        ]);
    }

    // Update original order's status to reflect the status of it's return/refund
    // $order - order to be updated
    // $status - status of the refund
    // return void
    public function updateOrder($order, $status)
    {
        if ($status < 2)
        {
            $order->update([
                'status' => 4
            ]);
        }

        $order->update([
            'status' => 2
        ]);
    }
}
