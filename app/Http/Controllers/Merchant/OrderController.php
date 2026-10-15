<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'items.menu'])
            ->where('merchant_id', auth()->user()->merchant->id)
            ->latest()
            ->paginate(10);

        return view('merchant.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->merchant_id !== auth()->user()->merchant->id) abort(403);
        $order->load(['customer', 'items.menu']);
        return view('merchant.orders.show', compact('order'));
    }

    public function updateStatus(Order $order)
    {
        if ($order->merchant_id !== auth()->user()->merchant->id) abort(403);

        request()->validate(['status' => 'required|in:pending,confirmed,completed']);
        $order->update(['status' => request('status')]);

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
