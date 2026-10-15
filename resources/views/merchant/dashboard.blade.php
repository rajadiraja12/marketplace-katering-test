@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard Merchant</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow">Total Menu: <b>{{ $totalMenu }}</b></div>
    <div class="bg-white p-4 rounded shadow">Total Order: <b>{{ $totalOrder }}</b></div>
    <div class="bg-white p-4 rounded shadow">Pendapatan (Selesai): <b>Rp {{ number_format($revenue, 0, ',', '.') }}</b></div>
</div>

<div class="flex gap-3">
    <a href="{{ route('merchant.menus.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Kelola Menu</a>
    <a href="{{ route('merchant.orders.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Lihat Order</a>
    <a href="{{ route('merchant.profile.edit') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Profil</a>
</div>
@endsection