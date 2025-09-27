{{-- <!DOCTYPE html>
<html lang="ar" dir="rtl">
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
</html> --}}

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محكمة النقض المصرية - العدالة الرقمية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Tajawal:wght@300;400;500;700&display=swap');
        
        * {
            font-family: 'Tajawal', sans-serif;
        }
        
        .arabic-title {
            font-family: 'Amiri', serif;
        }
        
        .dark-theme {
            background: #0a0a0a;
            color: #ffffff;
        }
        
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .neon-border {
            border: 2px solid transparent;
            background: linear-gradient(45deg, #d4af37, #ffd700) border-box;
            border-radius: 12px;
        }
        
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(212, 175, 55, 0.3), rgba(255, 215, 0, 0.3));
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-orb:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .floating-orb:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .floating-orb:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }
        
        .morphing-bg {
            background: linear-gradient(45deg, #1a1a2e, #16213e, #0f3460);
            animation: morphColor 8s ease-in-out infinite;
        }
        
        @keyframes morphColor {
            0%, 100% { background: linear-gradient(45deg, #1a1a2e, #16213e, #0f3460); }
            50% { background: linear-gradient(45deg, #16213e, #0f3460, #1a1a2e); }
        }
        
        .hexagon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #d4af37, #ffd700);
            position: relative;
            margin: 15px 0;
            border-radius: 12px;
            transform: rotate(0deg);
            transition: all 0.3s ease;
        }
        
        .hexagon:hover {
            transform: rotate(45deg) scale(1.1);
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
        }
        
        .typing-effect {
            border-right: 2px solid #d4af37;
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { border-color: transparent; }
            51%, 100% { border-color: #d4af37; }
        }
        
        .particle {
            position: absolute;
            background: #d4af37;
            border-radius: 50%;
            opacity: 0.7;
            animation: particleMove 4s linear infinite;
        }
        
        @keyframes particleMove {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 0.7; }
            90% { opacity: 0.7; }
            100% { transform: translateY(-100vh) scale(1); opacity: 0; }
        }
        
        .service-card {
            background: rgba(26, 26, 46, 0.8);
            border: 1px solid rgba(212, 175, 55, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .service-card:hover::before {
            left: 100%;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            border-color: #d4af37;
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.2);
        }
        
        .zigzag {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .menu-toggle {
            display: none;
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            .mobile-menu {
                transform: translateX(100%);
                transition: transform 0.3s ease-in-out;
            }
            
            .mobile-menu.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="dark-theme overflow-x-hidden">
    <!-- Floating Orbs Background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
    </div>
    <!-- Particles -->
    <div id="particles-container" class="fixed inset-0 pointer-events-none z-0"></div>

    <!-- Header -->
    <header class="relative z-50 glass-effect sticky top-0">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="hexagon flex items-center justify-center">
                        <i class="fas fa-balance-scale text-black text-xl"></i>
                    </div>
                    <div>
                        <h1 class="arabic-title text-2xl font-bold text-white">محكمة النقض</h1>
                        <p class="text-gray-300 text-sm">العدالة الرقمية</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8 space-x-reverse">
                    <a href="#home" class="text-white hover:text-yellow-400 transition-all duration-300 relative group">
                        الرئيسية
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#services" class="text-gray-300 hover:text-yellow-400 transition-all duration-300 relative group">
                        الخدمات
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#about" class="text-gray-300 hover:text-yellow-400 transition-all duration-300 relative group">
                        عن المحكمة
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="text-gray-300 hover:text-yellow-400 transition-all duration-300 relative group">
                        اتصل بنا
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4 space-x-reverse">
                    <a href="/login" wire:navigate class="px-6 py-2 border border-yellow-400 text-yellow-400 rounded-lg hover:bg-yellow-400 hover:text-black transition-all duration-300">
                        دخول
                    </a>
                    <a href="/register" wire:navigate class="px-6 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 text-black rounded-lg hover:from-yellow-300 hover:to-yellow-500 transform hover:scale-105 transition-all duration-300">
                        تسجيل
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="menu-toggle md:hidden text-white text-2xl" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden fixed top-0 right-0 w-80 h-full glass-effect z-40 p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-white">القائمة</h2>
                <button onclick="toggleMobileMenu()" class="text-white text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-6">
                <a href="#home" class="block text-white hover:text-yellow-400 text-lg transition-colors" onclick="toggleMobileMenu()">الرئيسية</a>
                <a href="#services" class="block text-gray-300 hover:text-yellow-400 text-lg transition-colors" onclick="toggleMobileMenu()">الخدمات</a>
                <a href="#about" class="block text-gray-300 hover:text-yellow-400 text-lg transition-colors" onclick="toggleMobileMenu()">عن المحكمة</a>
                <a href="#contact" class="block text-gray-300 hover:text-yellow-400 text-lg transition-colors" onclick="toggleMobileMenu()">اتصل بنا</a>
                <div class="border-t border-gray-600 pt-6 space-y-4">
                    <a href="/login" class="block px-6 py-3 border border-yellow-400 text-yellow-400 rounded-lg text-center hover:bg-yellow-400 hover:text-black transition-all">دخول</a>
                    <a href="/register" class="block px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-600 text-black rounded-lg text-center">تسجيل</a>
                </div>
            </div>
        </div>
    </header>

    
    <!-- Page Content -->
    <main class="flex-1 max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>


</body>
</html>