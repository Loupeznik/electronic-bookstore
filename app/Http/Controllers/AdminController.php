<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Order;
use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->take(10)->get();
        $assignedOrders = Order::where('assignee_id', Auth::user()->id)->where('status', '!=', 2)->where('status', '!=', 3)->latest()->take(10)->get();
        $assignedRefunds = OrderReturn::where('assignee_id', Auth::user()->id)->where('status', '!=', 2)->latest()->take(10)->get();
        $assignedConForms = ContactForm::where('assignee_id', Auth::user()->id)->where('status', 0)->latest()->take(10)->get();

        return view('dashboard', compact(['orders', 'assignedOrders', 'assignedRefunds', 'assignedConForms']));
    }

    public function reports()
    {
        return view('admin.reports');
    }
}
