<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NebulaCMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="border-b bg-white">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('public.home') }}" class="font-bold text-lg">NebulaCMS</a>

            <nav class="flex gap-4">
                @auth
                    <a class="underline" href="{{ route('admin.dashboard') }}">Admin</a>
                @else
                    <a class="underline" href="{{ route('login') }}">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
