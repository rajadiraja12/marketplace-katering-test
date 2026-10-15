@extends('layouts.app')
@section('content')
<div class="bg-white p-6 rounded shadow mb-4">
    <h1 class="text-2xl font-bold">{{ $merchant->company_name }}</h1>
    <p class="text-gray-600">{{ $merchant->location }}</p>
    <p class="mt-2">{{ $merchant->description }}</p>
</div>

<h2 class="font-bold mb-3">Daftar Menu</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse ($merchant->menus as $menu)
        <div class="bg-white rounded shadow overflow-hidden">
            @if ($menu->photo)
                <img src="{{ asset('storage/'.$menu->photo) }}" class="w-full h-40 object-cover">
            @endif
            <div class="p-4">
                <h3 class="font-bold">{{ $menu->name }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $menu->description }}</p>
                <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                <a href="{{ route('customer.orders.create', $menu) }}"
                   class="inline-block mt-2 bg-green-600 text-white px-3 py-1 rounded text-sm">Pesan</a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Belum ada menu.</p>
    @endforelse
</div>
@endsection