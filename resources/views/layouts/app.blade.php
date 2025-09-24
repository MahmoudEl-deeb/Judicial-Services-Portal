<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'محكمة النقض') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom Styles Stack -->
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50" style="font-family: 'Cairo', sans-serif;">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center gap-4">
                    <img src="/images/logo.png" alt="شعار محكمة النقض" class="w-12 h-12">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">محكمة النقض</h1>
                        <p class="text-sm text-gray-600">المملكة العربية السعودية</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">الخدمات</a>
                    <a href="/about" class="text-gray-700 hover:text-blue-600 font-medium">حول المحكمة</a>
                    <a href="/contact" class="text-gray-700 hover:text-blue-600 font-medium">تواصل معنا</a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">محكمة النقض</h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        نحن نقدم أفضل الخدمات القضائية الإلكترونية لضمان العدالة والشفافية
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">روابط مهمة</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/services" class="text-gray-300 hover:text-white">الخدمات</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-white">حول المحكمة</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-white">تواصل معنا</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">الدعم</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/help" class="text-gray-300 hover:text-white">المساعدة</a></li>
                        <li><a href="/faq" class="text-gray-300 hover:text-white">الأسئلة الشائعة</a></li>
                        <li><a href="/privacy" class="text-gray-300 hover:text-white">سياسة الخصوصية</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">تواصل معنا</h4>
                    <div class="text-sm text-gray-300 space-y-2">
                        <p>📧 info@cassation.gov.sa</p>
                        <p>📞 +966 11 123 4567</p>
                        <p>📍 الرياض، المملكة العربية السعودية</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} محكمة النقض - جميع الحقوق محفوظة</p>
            </div>
        </div>
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- Custom Scripts Stack -->
    @stack('scripts')
    
    <!-- Livewire Loading Indicator -->
    <div 
        wire:loading.flex 
        class="fixed inset-0 bg-black bg-opacity-30 items-center justify-center z-50"
        style="display: none;"
    >
        <div class="bg-white rounded-lg p-6 flex items-center gap-3">
            <div class="w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <span class="text-gray-700">جاري التحميل...</span>
        </div>
    </div>
</body>
</html>