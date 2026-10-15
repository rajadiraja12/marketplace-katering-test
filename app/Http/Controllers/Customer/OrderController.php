<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(Menu $menu)
    {
        return view('customer.orders.create', compact('menu'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_id'       => 'required|exists:menus,id',
            'quantity'      => 'required|integer|min:1',
            'delivery_date' => 'required|date|after_or_equal:today',
        ]);

        $menu = Menu::findOrFail($data['menu_id']);
        $total = $menu->price * $data['quantity'];

        DB::beginTransaction();
        try {
            $order = Order::create([
                'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3))),
                'customer_id'    => auth()->id(),
                'merchant_id'    => $menu->merchant_id,
                'delivery_date'  => $data['delivery_date'],
                'total_amount'   => $total,
                'status'         => 'pending',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'  => $menu->id,
                'quantity' => $data['quantity'],
                'price'    => $menu->price,
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function index()
    {
        $orders = Order::with('merchant')
            ->where('customer_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== auth()->id()) abort(403);
        $order->load(['items.menu', 'merchant']);
        return view('customer.orders.show', compact('order'));
    }

    public function invoice(Order $order)
    {
        if ($order->customer_id !== auth()->id() && $order->merchant_id !== optional(auth()->user()->merchant)->id) {
            abort(403);
        }

        $order->load(['items.menu', 'merchant', 'customer']);
        return view('invoices.pdf', compact('order'));
    }
}
