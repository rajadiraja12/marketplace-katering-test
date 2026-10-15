@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Login</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-3">
        @csrf
        <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" class="w-full border p-2 rounded" required>
        <input name="password" type="password" placeholder="Password" class="w-full border p-2 rounded" required>
        <button class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
    </form>

    <p class="mt-4 text-sm">Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600">Daftar</a>
    </p>
</div>
@endsection