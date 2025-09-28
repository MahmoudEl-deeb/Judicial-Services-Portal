<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="app()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محكمة النقض المصرية - نظام الخدمات القضائية الإلكترونية</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @livewireStyles
    @vite( ['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap');
        
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .scale-icon {
            background: linear-gradient(45deg, #d4af37, #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-pattern {
            background-image: radial-gradient(circle at 25px 25px, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 50px 50px;
        }
        
        .stats-counter {
            font-weight: 700;
            font-size: 2.5rem;
            color: #1e40af;
        }

        .mobile-menu {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body>
        <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-800 to-blue-600 rounded-full flex items-center justify-center">
                    <img src="{{ asset('storage/landing-page/unnamed.webp') }}" 
                         alt="Logo" class="h-16 w-auto">                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-blue-800">محكمة النقض المصرية</h1>
                        <p class="text-sm text-gray-600">نظام الخدمات القضائية الإلكترونية</p>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8 space-x-reverse">
                    <a href="/" class="transition-colors" wire:navigate
                       :class="activeSection === 'home' ? 'text-blue-800 font-bold' : 'text-gray-600 hover:text-blue-600'">
                       الرئيسية
                    </a>
                    <a href="/services" class="transition-colors" wire:navigate
                       :class="activeSection === 'services' ? 'text-blue-800 font-bold' : 'text-gray-600 hover:text-blue-600'">
                       الخدمات
                    </a>
                    <a href="#about" class="transition-colors" wire:navigate
                       :class="activeSection === 'about' ? 'text-blue-800 font-bold' : 'text-gray-600 hover:text-blue-600'">
                       عن المحكمة
                    </a>
                    <a href="#contact" class="transition-colors" wire:navigate
                       :class="activeSection === 'contact' ? 'text-blue-800 font-bold' : 'text-gray-600 hover:text-blue-600'">
                       اتصل بنا
                    </a>
                </nav>
                
                @guest
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <a href="/login" wire:navigate class="px-6 py-2 text-blue-800 border border-blue-800 rounded-lg hover:bg-blue-50 transition-colors hidden md:block">تسجيل الدخول</a>
                    <a href="/register" wire:navigate class="px-6 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700 transition-colors hidden md:block">إنشاء حساب</a>
                    
                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg bg-blue-50 text-blue-800">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                @endguest
                @auth
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <span class="text-gray-700">{{ Auth::user()->first_name }}</span>
                            <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ auth()->user()->getDashboardRoute() }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">لوحة التحكم</a>
                            <a href="{{ route('profile.show') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">الملف الشخصي</a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-right block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="md:hidden mobile-menu bg-white border-t mt-4 py-4">
                <div class="flex flex-col space-y-4">
                    <a href="/" wire:navigate @click="mobileMenuOpen = false" class="py-2 px-4 rounded-lg hover:bg-blue-50"
                       :class="activeSection === 'home' ? 'bg-blue-50 text-blue-800 font-bold' : 'text-gray-600'">
                       الرئيسية
                    </a>
                    <a href="/services" wire:navigate @click="mobileMenuOpen = false" class="py-2 px-4 rounded-lg hover:bg-blue-50"
                       :class="activeSection === 'services' ? 'bg-blue-50 text-blue-800 font-bold' : 'text-gray-600'">
                       الخدمات
                    </a>
                    <a href="#about" wire:navigate @click="mobileMenuOpen = false" class="py-2 px-4 rounded-lg hover:bg-blue-50"
                       :class="activeSection === 'about' ? 'bg-blue-50 text-blue-800 font-bold' : 'text-gray-600'">
                       عن المحكمة
                    </a>
                    <a href="#contact" wire:navigate @click="mobileMenuOpen = false" class="py-2 px-4 rounded-lg hover:bg-blue-50"
                       :class="activeSection === 'contact' ? 'bg-blue-50 text-blue-800 font-bold' : 'text-gray-600'">
                       اتصل بنا
                    </a>
                    <div class="border-t pt-4 flex flex-col space-y-2">
                        <a href="/login" wire:navigate @click="mobileMenuOpen = false" class="py-2 px-4 text-blue-800 border border-blue-800 rounded-lg text-center">تسجيل الدخول</a>
                        <a href="/register" @click="mobileMenuOpen = false" class="py-2 px-4 bg-blue-800 text-white rounded-lg text-center">إنشاء حساب</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

                <!-- Page Content -->
             <main>
                {{ $slot }}
            </main>

       <!-- Footer -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-4 space-x-reverse mb-6">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-balance-scale text-blue-900 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xl">محكمة النقض</h4>
                            <p class="text-blue-300 text-sm">المصرية</p>
                        </div>
                    </div>
                    <p class="text-blue-300 mb-4">أعلى محكمة في النظام القضائي المصري</p>
                    <div class="flex space-x-4 space-x-reverse">
                        <template x-for="(social, index) in ['facebook-f', 'twitter', 'linkedin-in']" :key="index">
                            <a href="#" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i :class="`fab fa-${social}`"></i>
                            </a>
                        </template>
                    </div>
                </div>
                
                <template x-for="(links, index) in [
                    { title: 'روابط سريعة', items: ['الصفحة الرئيسية', 'الخدمات الإلكترونية', 'الأحكام والسوابق', 'التشريعات'] },
                    { title: 'الخدمات', items: ['تقديم طعن', 'الاستعلام عن القضايا', 'الشهادات', 'الدفع الإلكتروني'] }
                ]" :key="index">
                    <div>
                        <h5 class="font-bold text-lg mb-4" x-text="links.title"></h5>
                        <ul class="space-y-2 text-blue-300">
                            <template x-for="(item, itemIndex) in links.items" :key="itemIndex">
                                <li><a href="#" class="hover:text-white transition-colors" x-text="item"></a></li>
                            </template>
                        </ul>
                    </div>
                </template>
                
                <div>
                    <h5 class="font-bold text-lg mb-4">ساعات العمل</h5>
                    <div class="text-blue-300 space-y-2">
                        <p>السبت - الخميس: 9:00 ص - 3:00 م</p>
                        <p>الجمعة: مغلق</p>
                        <p>الخدمات الإلكترونية: 24/7</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-300">
                <p>&copy; 2024 محكمة النقض المصرية. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <script>
        function app() {
            return {
                // Alpine.js data and methods will be handled by x-data
            }
        }

        // // Smooth scrolling for navigation links
        // document.addEventListener('alpine:init', () => {
        //     Alpine.data('app', () => ({
        //         // Data is already defined in x-data attribute
        //     }))
        // });
    </script>
    @livewireScripts
</body>
</html>
