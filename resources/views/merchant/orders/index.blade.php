@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Order Masuk</h1>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Invoice</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-right">Total</th>
                <th class="p-3 text-center">Status</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="border-t">
                    <td class="p-3">{{ $order->invoice_number }}</td>
                    <td class="p-3">{{ $order->customer->name }}</td>
                    <td class="p-3">{{ $order->delivery_date }}</td>
                    <td class="p-3 text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 rounded text-xs bg-gray-200">{{ $order->status }}</span>
                    </td>
                    <td class="p-3 text-right">
                        <a href="{{ route('merchant.orders.show', $order) }}" class="text-blue-600">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $orders->links() }}</div>
@endsection