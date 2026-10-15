@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard Customer</h1>

<div class="flex gap-3 mb-6">
    <a href="{{ route('customer.merchants.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Cari Katering</a>
    <a href="{{ route('customer.orders.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Pesanan Saya</a>
</div>

<h2 class="font-bold mb-2">Pesanan Terakhir</h2>
<div class="bg-white rounded shadow">
    @forelse ($orders as $order)
        <div class="p-3 border-b flex justify-between">
            <div>
                <p class="font-semibold">{{ $order->invoice_number }}</p>
                <p class="text-sm text-gray-600">{{ $order->merchant->company_name }}</p>
            </div>
            <a href="{{ route('customer.orders.show', $order) }}" class="text-blue-600">Detail</a>
        </div>
    @empty
        <p class="p-3 text-gray-500">Belum ada pesanan.</p>
    @endforelse
</div>
@endsection