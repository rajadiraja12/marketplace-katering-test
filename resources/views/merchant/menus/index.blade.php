@extends('layouts.app')
@section('content')
<a href="{{ route('merchant.dashboard') }}" class="text-blue-600">&larr; Kembali</a>
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Menu Saya</h1>
    <a href="{{ route('merchant.menus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Menu</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse ($menus as $menu)
        <div class="bg-white rounded shadow overflow-hidden">
            @if ($menu->photo)
                <img src="{{ asset('storage/'.$menu->photo) }}" class="w-full h-40 object-cover">
            @endif
            <div class="p-4">
                <h3 class="font-bold">{{ $menu->name }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $menu->description }}</p>
                <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('merchant.menus.edit', $menu) }}" class="text-yellow-600 text-sm">Edit</a>
                    <form method="POST" action="{{ route('merchant.menus.destroy', $menu) }}" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Belum ada menu.</p>
    @endforelse
</div>
@endsection