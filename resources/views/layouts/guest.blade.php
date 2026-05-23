<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-white">
    {{-- Mini Navbar --}}
    <nav class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('home.index') }}">
                <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
            </a>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-gray-900 transition {{ request()->routeIs('login') ? 'font-semibold text-gray-900' : '' }}">
                    Sign in
                </a>
                <a href="{{ route('register') }}"
                    class="bg-green-700 text-white rounded-full px-4 py-2 hover:bg-green-800 transition {{ request()->routeIs('register') ? 'ring-2 ring-green-300' : '' }}">
                    Get started
                </a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="min-h-[calc(100vh-4rem)] flex flex-col sm:justify-center items-center px-4 py-12">
        <div class="w-full sm:max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    @yield('auth-title', 'Welcome')
                </h1>
                <p class="text-gray-500 mt-2">
                    @yield('auth-subtitle', '')
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8">
                {{ $slot }}
            </div>

            <p class="text-center text-xs text-gray-400 mt-8">
                &copy; {{ date('Y') }} Medium Clone. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>