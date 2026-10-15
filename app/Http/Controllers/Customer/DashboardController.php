<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('merchant')
            ->where('customer_id', auth()->id())
            ->latest()
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact('orders'));
    }
}
