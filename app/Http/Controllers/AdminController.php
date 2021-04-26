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
        $assignedOrders = Order::where('assignee_id', Auth::user()->id)->latest()->get();
        $assignedRefunds = OrderReturn::where('assignee_id', Auth::user()->id)->latest()->get();
        $assignedConForms = ContactForm::where('assignee_id', Auth::user()->id)->latest()->get();

        return view('dashboard', compact(['orders', 'assignedOrders', 'assignedRefunds', 'assignedConForms']));
    }
}
