@extends('layouts.app')
@section('content')
<a href="{{ route('customer.merchants.index') }}" class="text-blue-600">&larr; Kembali</a>
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Buat Pesanan</h1>

    <div class="mb-4 border-b pb-3">
        <p class="font-bold">{{ $menu->name }}</p>
        <p class="text-sm text-gray-600">{{ $menu->description }}</p>
        <p class="text-blue-600 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">
            @foreach ($errors->all() as $e) <p>{{ $e }}</p> @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('customer.orders.store') }}" class="space-y-3">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        <label class="block">
            <span class="text-sm">Jumlah Porsi</span>
            <input type="number" name="quantity" min="1" value="1" class="w-full border p-2 rounded" required>
        </label>
        <label class="block">
            <span class="text-sm">Tanggal Pengiriman</span>
            <input type="date" name="delivery_date" min="{{ date('Y-m-d') }}"
                   value="{{ date('Y-m-d') }}" class="w-full border p-2 rounded" required>
        </label>
        <button class="w-full bg-green-600 text-white p-2 rounded">Buat Pesanan</button>
    </form>
</div>
@endsection