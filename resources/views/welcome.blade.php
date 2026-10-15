@extends('layouts.app')
@section('content')
<div class="text-center py-16">
    <h1 class="text-4xl font-bold mb-4">Marketplace Katering</h1>
    <p class="text-gray-600 mb-6">Platform penghubung katering & kantor</p>
    @guest
        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded mr-2">Login</a>
        <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-2 rounded">Daftar</a>
    @else
        <a href="{{ auth()->user()->isMerchant() ? route('merchant.dashboard') : route('customer.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded">Ke Dashboard</a>
    @endguest
</div>
@endsection