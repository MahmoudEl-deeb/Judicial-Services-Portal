<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="{ sidebarOpen: false }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="flex justify-between items-center px-6 py-4">
            <!-- Logo and Title -->
            <div class="flex items-center space-x-4 space-x-reverse">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full flex items-center justify-center">
                    <img src="{{ asset('storage/landing-page/unnamed.webp') }}" alt="Logo" class="h-16 w-auto">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-blue-800">محكمة النقض المصرية</h1>
                    <p class="text-sm text-gray-600">نظام الخدمات القضائية الإلكترونية</p>
                </div>
            </div>
            <div class="flex items-center space-x-4 space-x-reverse">
                <!-- Sidebar Toggle -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded bg-gray-100">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
                <h1 class="text-lg font-bold text-blue-800">لوحة التحكم</h1>
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700">{{ Auth::user()->first_name }}</span>
                    <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">الملف الشخصي</a>
                    <div class="border-t border-gray-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-right block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed md:static inset-y-0 right-0 w-64 bg-blue-900 text-white transform md:translate-x-0 transition-transform duration-200 ease-in-out z-40">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-6">القائمة</h2>
                <nav class="space-y-2">
                    @foreach($links as $link)
                        <a href="{{ $link['url'] }}" class="block px-4 py-2 rounded hover:bg-blue-800 transition"
                            @class(['bg-blue-800 font-bold' => request()->is($link['active'] ?? '')])>
                            <i class="{{ $link['icon'] ?? 'fas fa-circle' }} ml-2"></i>
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

</body>

</html>