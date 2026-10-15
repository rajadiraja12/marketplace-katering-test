@extends('layouts.app')
@section('content')
<a href="{{ route('customer.dashboard') }}" class="text-blue-600">&larr; Kembali</a>
<h1 class="text-2xl font-bold mb-4">Pesanan Saya</h1>

<div class="bg-white rounded shadow">
    @forelse ($orders as $order)
        <div class="p-3 border-b flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $order->invoice_number }}</p>
                <p class="text-sm text-gray-600">{{ $order->merchant->company_name }}</p>
                <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}</p>
            </div>
            <div class="text-right">
                <p class="font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                <a href="{{ route('customer.orders.show', $order) }}" class="text-blue-600 text-sm">Detail</a>
            </div>
        </div>
    @empty
        <p class="p-3 text-gray-500">Belum ada pesanan.</p>
    @endforelse
</div>

<div class="mt-4">{{ $orders->links() }}</div>
@endsection