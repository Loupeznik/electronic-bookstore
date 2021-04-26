<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderReturn;
use App\Models\User;

class OrderReturnController extends Controller
{
    /**
     * Display paginated list of pending order returns.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returns = OrderReturn::with(['order', 'assignee'])->whereNull('result')->latest()->paginate(30);

        return view('admin.returns.index', compact('returns'));
    }

    /**
     * Display paginated list of finished order returns.
     *
     * @return \Illuminate\Http\Response
     */
    public function finished()
    {
        $returns = OrderReturn::with(['order', 'assignee'])->whereNotNull('result')->latest()->paginate(30);

        return view('admin.returns.index', compact('returns'));
    }

    /**
     * Show order return create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = User::where('role', 2)->get();

        return view('admin.returns.create', compact('admins'));
    }

    /**
     * Store new order return.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $refund = OrderReturn::create($this->validateInput($request));
        $this->updateOrder($refund->order, $request->status);

        return redirect('/admin/refunds')->with('status', 'success')->with('message', 'Order return has been created');
    }

    /**
     * Display specific order return.
     *
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function show(OrderReturn $refund)
    {
        return view('admin.returns.detail', compact('refund'));
    }

    /**
     * Show order return edit page.
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
     * Update specific order return.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderReturn $refund)
    {
        $refund->update($this->validateInput($request));
        $this->updateOrder($refund->order, $request->status);

        return redirect('/admin/refunds')->with('status', 'success')->with('message', 'Order return has been updated');
    }

    /**
     * Remove the specified order return.
     *
     * @param  \App\Models\OrderReturn $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderReturn $refund)
    {
        $refund->delete();

        return redirect('/admin/refunds')->with('status', 'success')->with('message', 'Order return has been deleted');
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

    /** 
     * Update original order's status to reflect the status of it's return/refund.
     * 
     * @param App\Models\Order $order
     * @param $status (status of the refund)
     * @return void
    */
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
