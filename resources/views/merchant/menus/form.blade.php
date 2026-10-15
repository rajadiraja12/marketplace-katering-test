@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">
        {{ $menu->exists ? 'Edit Menu' : 'Tambah Menu' }}
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $menu->exists ? route('merchant.menus.update', $menu) : route('merchant.menus.store') }}"
          enctype="multipart/form-data" class="space-y-3">
        @csrf
        @if ($menu->exists) @method('PUT') @endif

        <input name="name" value="{{ old('name', $menu->name) }}" placeholder="Nama Menu"
               class="w-full border p-2 rounded" required>
        <textarea name="description" placeholder="Deskripsi"
                  class="w-full border p-2 rounded">{{ old('description', $menu->description) }}</textarea>
        <input name="price" type="number" min="0" step="100"
               value="{{ old('price', $menu->price) }}" placeholder="Harga"
               class="w-full border p-2 rounded" required>
        <input type="file" name="photo" accept="image/*" class="w-full">

        @if ($menu->photo)
            <img src="{{ asset('storage/'.$menu->photo) }}" class="h-24 rounded">
        @endif

        <button class="w-full bg-blue-600 text-white p-2 rounded">Simpan</button>
    </form>
</div>
@endsection