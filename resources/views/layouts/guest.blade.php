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

    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- App Name -->
            <a href="{{ url('/') }}" 
               class="text-2xl font-bold text-gray-700 hover:text-gray-900 transition">
                {{ config('app.name', 'MyApp') }}
            </a>

            <!-- Nav buttons -->
            <nav class="space-x-4">
                @guest
                    <a href="{{ route('login') }}" 
                       wire:navigate
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       wire:navigate
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Register
                    </a>
                @endguest

                @auth
                    <button wire:click="logout" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Logout
                    </button>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-1 max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
