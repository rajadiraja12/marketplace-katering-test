<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace Katering</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow">
        <div class="container mx-auto flex justify-between p-4">
            <a href="/" class="font-bold text-lg">Marketplace Katering</a>
            @auth
                <div class="flex items-center gap-4">
                    <span>{{ auth()->user()->name }} - {{ auth()->user()->role }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="container mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>