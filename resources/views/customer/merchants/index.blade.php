@extends('layouts.app')
@section('content')
<a href="{{ route('customer.dashboard') }}" class="text-blue-600">&larr; Kembali</a>
<h1 class="text-2xl font-bold mb-4">Cari Katering</h1>

<form class="flex gap-2 mb-4">
    <input name="location" value="{{ request('location') }}" placeholder="Lokasi" class="border p-2 rounded w-1/3">
    <input name="menu" value="{{ request('menu') }}" placeholder="Nama menu" class="border p-2 rounded w-1/3">
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Cari</button>
</form>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse ($merchants as $merchant)
        <div class="bg-white rounded shadow p-4">
            @if ($merchant->logo)
                <img src="{{ asset('storage/'.$merchant->logo) }}" class="h-32 w-full object-cover rounded mb-2">
            @endif
            <h3 class="font-bold">{{ $merchant->company_name }}</h3>
            <p class="text-sm text-gray-600">{{ $merchant->location }}</p>
            <p class="text-sm text-gray-500 line-clamp-2">{{ $merchant->description }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $merchant->menus_count }} menu tersedia</p>
            <a href="{{ route('customer.merchants.show', $merchant) }}"
               class="inline-block mt-2 bg-blue-600 text-white px-3 py-1 rounded text-sm">Lihat Menu</a>
        </div>
    @empty
        <p class="text-gray-500">Tidak ada katering ditemukan.</p>
    @endforelse
</div>

<div class="mt-4">{{ $merchants->withQueryString()->links() }}</div>
@endsection