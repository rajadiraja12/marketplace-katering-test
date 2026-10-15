@extends('layouts.app')
@section('content')
<a href="{{ route('customer.orders.index') }}" class="text-blue-600">&larr; Kembali</a>

<div class="bg-white p-6 rounded shadow mt-3">
    <div class="flex justify-between">
        <h1 class="text-xl font-bold">{{ $order->invoice_number }}</h1>
        <span class="px-3 py-1 rounded bg-gray-200 text-sm">{{ $order->status }}</span>
    </div>
    <p class="text-sm text-gray-600 mt-2">Merchant: {{ $order->merchant->company_name }}</p>
    <p class="text-sm text-gray-600">Tanggal Kirim: {{ $order->delivery_date }}</p>

    <table class="w-full mt-4 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Menu</th>
                <th class="p-2 text-right">Harga</th>
                <th class="p-2 text-center">Qty</th>
                <th class="p-2 text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->menu->name }}</td>
                    <td class="p-2 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="p-2 text-center">{{ $item->quantity }}</td>
                    <td class="p-2 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border-t font-bold">
                <td colspan="3" class="p-2 text-right">Total</td>
                <td class="p-2 text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <a href="{{ route('invoice.download', $order) }}"
       class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">Download Invoice</a>
</div>
@endsection