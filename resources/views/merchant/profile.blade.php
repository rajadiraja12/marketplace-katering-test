@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Profil Merchant</h1>

    <form method="POST" action="{{ route('merchant.profile.update') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf @method('PUT')
        <input name="company_name" value="{{ old('company_name', $merchant->company_name) }}"
               class="w-full border p-2 rounded" required>
        <textarea name="description" class="w-full border p-2 rounded"
                  placeholder="Deskripsi">{{ old('description', $merchant->description) }}</textarea>
        <input name="location" value="{{ old('location', $merchant->location) }}"
               placeholder="Lokasi" class="w-full border p-2 rounded">

        @if ($merchant->logo)
            <img src="{{ asset('storage/'.$merchant->logo) }}" class="h-20">
        @endif
        <input type="file" name="logo" accept="image/*" class="w-full">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection