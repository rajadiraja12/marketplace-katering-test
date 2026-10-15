@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Daftar Akun</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-3">
        @csrf
        <select name="role" id="role" class="w-full border p-2 rounded" required>
            <option value="customer" @selected(old('role')=='customer')>Customer (Kantor)</option>
            <option value="merchant" @selected(old('role')=='merchant')>Merchant (Katering)</option>
        </select>

        <input name="name"     placeholder="Nama"      value="{{ old('name') }}"     class="w-full border p-2 rounded" required>
        <input name="email"    type="email" placeholder="Email" value="{{ old('email') }}" class="w-full border p-2 rounded" required>
        <input name="phone"    placeholder="No. Telepon" value="{{ old('phone') }}"  class="w-full border p-2 rounded">
        <textarea name="address" placeholder="Alamat" class="w-full border p-2 rounded">{{ old('address') }}</textarea>

        <div id="merchantFields" class="space-y-3 hidden">
            <input name="company_name" placeholder="Nama Perusahaan Katering" value="{{ old('company_name') }}" class="w-full border p-2 rounded">
            <input name="location"     placeholder="Lokasi"                   value="{{ old('location') }}"     class="w-full border p-2 rounded">
        </div>

        <input name="password" type="password" placeholder="Password" class="w-full border p-2 rounded" required>
        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full border p-2 rounded" required>

        <button class="w-full bg-green-600 text-white p-2 rounded">Daftar</button>
    </form>

    <p class="mt-4 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600">Login</a></p>
</div>

<script>
    const role = document.getElementById('role');
    const fields = document.getElementById('merchantFields');
    function toggle() { fields.classList.toggle('hidden', role.value !== 'merchant'); }
    role.addEventListener('change', toggle); toggle();
</script>
@endsection