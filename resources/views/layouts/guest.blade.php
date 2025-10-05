<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="app()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محكمة النقض المصرية - النظام الإلكتروني للخدمات القضائية</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --gold-primary: #D4AF37;
            --gold-secondary: #B8941F;
            --gold-light: #F7EFD8;
            --grey-dark: #2D3748;
            --grey-medium: #4A5568;
            --grey-light: #718096;
            --grey-bg: #F8FAFC;
            --white: #FFFFFF;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--grey-bg);
        }
        
        .gold-gradient {
            background: linear-gradient(135deg, var(--gold-primary) 0%, var(--gold-secondary) 100%);
        }
        
        .gold-text {
            color: var(--gold-primary);
        }
        
        .gold-bg {
            background-color: var(--gold-primary);
        }
        
        .grey-dark-bg {
            background-color: var(--grey-dark);
        }
        
        .grey-medium-text {
            color: var(--grey-medium);
        }
        
        .grey-light-text {
            color: var(--grey-light);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            right: 0;
            background-color: var(--gold-primary);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .card-hover {
            transition: all 0.3s ease;
            border: 1px solid #E2E8F0;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: var(--gold-primary);
        }
        
        .gold-border {
            border-color: var(--gold-primary);
        }
        
        .stats-counter {
            font-weight: 700;
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--gold-primary) 0%, var(--gold-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
            background-size: 50px 50px;
        }
        
        .mobile-menu {
            transition: all 0.3s ease-in-out;
        }
        
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--gold-primary) 50%, transparent 100%);
        }
    </style>
</head>
<body class="bg-[#F8FAFC]">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50 border-b gold-border">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-3">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="w-14 h-14 rounded-full overflow-hidden border-2 gold-border shadow-md">
                        <img src="{{ asset('storage/landing-page/unnamed.webp') }}" 
                             alt="شعار محكمة النقض المصرية" class="h-full w-full object-cover">
                    </div>
                    <div class="border-r-2 border-gray-200 pr-4">
                        <h1 class="text-xl font-bold grey-dark-text">محكمة النقض المصرية</h1>
                        <p class="text-xs grey-light-text">النظام الإلكتروني للخدمات القضائية</p>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8 space-x-reverse">
                    <a href="/" class="nav-link py-2 px-1 font-medium transition-all duration-300"
                       :class="activeSection === 'home' ? 'gold-text active font-semibold' : 'grey-medium-text hover:gold-text'">
                       الرئيسية
                    </a>
                    <a href="/services" class="nav-link py-2 px-1 font-medium transition-all duration-300"
                       :class="activeSection === 'services' ? 'gold-text active font-semibold' : 'grey-medium-text hover:gold-text'">
                       الخدمات الإلكترونية
                    </a>
                    <a href="#about" class="nav-link py-2 px-1 font-medium transition-all duration-300"
                       :class="activeSection === 'about' ? 'gold-text active font-semibold' : 'grey-medium-text hover:gold-text'">
                       عن المحكمة
                    </a>
                    <a href="#contact" class="nav-link py-2 px-1 font-medium transition-all duration-300"
                       :class="activeSection === 'contact' ? 'gold-text active font-semibold' : 'grey-medium-text hover:gold-text'">
                       اتصل بنا
                    </a>
                </nav>
                
                @guest
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3 space-x-reverse">
                    <a href="/login" class="px-5 py-2 gold-text border gold-border rounded-lg hover:bg-gold-light transition-all duration-300 font-medium hidden md:block">
                        تسجيل الدخول
                    </a>
                    <a href="/register" class="px-5 py-2 gold-bg text-white rounded-lg hover:bg-[#B8941F] transition-all duration-300 font-medium shadow-md hidden md:block">
                        إنشاء حساب
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg bg-gold-light gold-text">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
                @endguest
                
                @auth
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 space-x-reverse focus:outline-none bg-gold-light px-4 py-2 rounded-lg gold-text font-medium">
                            <span>{{ Auth::user()->first_name }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border gold-border">
                            <a href="{{ auth()->user()->getDashboardRoute() }}" class="block px-4 py-2 text-sm grey-medium-text hover:bg-gold-light transition-colors">
                                <i class="fas fa-tachometer-alt ml-2"></i>
                                لوحة التحكم
                            </a>
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm grey-medium-text hover:bg-gold-light transition-colors">
                                <i class="fas fa-user ml-2"></i>
                                الملف الشخصي
                            </a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                class="w-full text-right block px-4 py-2 text-sm grey-medium-text hover:bg-gold-light transition-colors" 
                                wire:submit>
                                    <i class="fas fa-sign-out-alt ml-2"></i>
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
                 class="lg:hidden mobile-menu bg-white border-t mt-3 py-4 rounded-lg shadow-lg">
                <div class="flex flex-col space-y-3">
                    <a href="#home" @click="mobileMenuOpen = false" 
                       class="py-3 px-4 rounded-lg transition-all duration-300 font-medium"
                       :class="activeSection === 'home' ? 'bg-gold-light gold-text font-semibold' : 'grey-medium-text hover:bg-gold-light'">
                       <i class="fas fa-home ml-2"></i>
                       الرئيسية
                    </a>
                    <a href="#services" @click="mobileMenuOpen = false" 
                       class="py-3 px-4 rounded-lg transition-all duration-300 font-medium"
                       :class="activeSection === 'services' ? 'bg-gold-light gold-text font-semibold' : 'grey-medium-text hover:bg-gold-light'">
                       <i class="fas fa-cogs ml-2"></i>
                       الخدمات الإلكترونية
                    </a>
                    <a href="#about" @click="mobileMenuOpen = false" 
                       class="py-3 px-4 rounded-lg transition-all duration-300 font-medium"
                       :class="activeSection === 'about' ? 'bg-gold-light gold-text font-semibold' : 'grey-medium-text hover:bg-gold-light'">
                       <i class="fas fa-info-circle ml-2"></i>
                       عن المحكمة
                    </a>
                    <a href="#contact" @click="mobileMenuOpen = false" 
                       class="py-3 px-4 rounded-lg transition-all duration-300 font-medium"
                       :class="activeSection === 'contact' ? 'bg-gold-light gold-text font-semibold' : 'grey-medium-text hover:bg-gold-light'">
                       <i class="fas fa-phone ml-2"></i>
                       اتصل بنا
                    </a>
                    <div class="border-t border-gray-200 pt-4 flex flex-col space-y-2">
                        <a href="/login" @click="mobileMenuOpen = false" class="py-2 px-4 gold-text border gold-border rounded-lg text-center font-medium">
                            تسجيل الدخول
                        </a>
                        <a href="/register" @click="mobileMenuOpen = false" class="py-2 px-4 gold-bg text-white rounded-lg text-center font-medium">
                            إنشاء حساب
                        </a>
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
    <footer class="grey-dark-bg text-white pt-12 pb-8 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-4 space-x-reverse mb-6">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center overflow-hidden border gold-border">
                            <img src="{{ asset('storage/landing-page/unnamed.webp') }}" 
                                 alt="شعار المحكمة" class="h-10 w-10 object-cover rounded-full">
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">محكمة النقض المصرية</h4>
                            <p class="text-gold-primary text-sm">أعلى هيئة قضائية</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4 text-sm leading-relaxed">
                        المحكمة العليا في جمهورية مصر العربية، تختص بنظر الطعون في الأحكام النهائية والصادرة من محاكم الاستئناف.
                    </p>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="#" class="w-9 h-9 bg-[#4A5568] rounded-full flex items-center justify-center hover:bg-gold-primary transition-all duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-[#4A5568] rounded-full flex items-center justify-center hover:bg-gold-primary transition-all duration-300">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-[#4A5568] rounded-full flex items-center justify-center hover:bg-gold-primary transition-all duration-300">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h5 class="font-bold text-lg mb-4 gold-text">روابط سريعة</h5>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            الصفحة الرئيسية
                        </a></li>
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            الخدمات الإلكترونية
                        </a></li>
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            الأحكام والسوابق
                        </a></li>
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            التشريعات والقوانين
                        </a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-bold text-lg mb-4 gold-text">الخدمات</h5>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            تقديم طعن بالنقض
                        </a></li>
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            الاستعلام عن القضايا
                        </a></li>
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            الشهادات والإفادات
                        </a></li>
                        <li><a href="#" class="hover:gold-text transition-colors duration-300 flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-1"></i>
                            الدفع الإلكتروني
                        </a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-bold text-lg mb-4 gold-text">معلومات التواصل</h5>
                    <div class="text-gray-300 space-y-3">
                        <div class="flex items-start space-x-2 space-x-reverse">
                            <i class="fas fa-map-marker-alt gold-text mt-1"></i>
                            <p>محكمة النقض - مجمع المحاكم - القاهرة - مصر</p>
                        </div>
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <i class="fas fa-phone gold-text"></i>
                            <p>+20 2 2794 1234</p>
                        </div>
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <i class="fas fa-envelope gold-text"></i>
                            <p>info@cassation.gov.eg</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-[#4A5568] mt-8 pt-6 text-center text-gray-400">
                <p class="text-sm">&copy; 2024 محكمة النقض المصرية. جميع الحقوق محفوظة.</p>
                <p class="text-xs mt-1">تم التطوير بواسطة إدارة تكنولوجيا المعلومات - محكمة النقض</p>
            </div>
        </div>
    </footer>

    <script>
        function app() {
            return {
                activeSection: 'home',
                mobileMenuOpen: false,
            }
        }
    </script>
</body>
</html>