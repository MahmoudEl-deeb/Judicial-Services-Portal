

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

    <!-- Hero Section -->
    <section id="home" class="morphing-bg relative min-h-screen flex items-center justify-center zigzag overflow-hidden">
        <div class="container mx-auto px-6 text-center z-10">
            <div class="mb-8">
                <div class="inline-block p-4 glass-effect rounded-full mb-6 transform hover:rotate-12 transition-transform duration-300">
                    <i class="fas fa-gavel text-6xl text-yellow-400"></i>
                </div>
            </div>
            
            <h2 class="arabic-title text-6xl md:text-8xl font-bold text-white mb-6 leading-tight">
                محكمة النقض
                <span class="block text-4xl md:text-5xl text-yellow-400 typing-effect" id="typing-text">المصرية</span>
            </h2>
            
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
                نحو مستقبل رقمي للعدالة المصرية - تقنيات متطورة لخدمة المواطنين والمحامين
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="/register" class="group px-10 py-4 bg-gradient-to-r from-yellow-400 to-yellow-600 text-black rounded-full font-bold text-lg transform hover:scale-110 transition-all duration-300 hover:shadow-2xl">
                    <span class="flex items-center">
                        <i class="fas fa-rocket ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                        ابدأ رحلتك الرقمية
                    </span>
                </a>
                <a href="#services" class="px-10 py-4 glass-effect text-white rounded-full font-bold text-lg border border-yellow-400 hover:bg-yellow-400 hover:text-black transition-all duration-300">
                    <span class="flex items-center">
                        <i class="fas fa-compass ml-3"></i>
                        استكشف الخدمات
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Modern Stats -->
    <section class="py-20 relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="glass-effect p-8 rounded-2xl group-hover:scale-105 transition-transform duration-300">
                        <div class="text-5xl font-bold text-yellow-400 mb-2" data-target="25000">0</div>
                        <p class="text-gray-300 font-medium">قضية سنوياً</p>
                        <div class="w-full h-1 bg-gray-700 rounded mt-4">
                            <div class="h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded animate-pulse"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="glass-effect p-8 rounded-2xl group-hover:scale-105 transition-transform duration-300">
                        <div class="text-5xl font-bold text-yellow-400 mb-2" data-target="1200">0</div>
                        <p class="text-gray-300 font-medium">محامي مُسجل</p>
                        <div class="w-full h-1 bg-gray-700 rounded mt-4">
                            <div class="h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded animate-pulse" style="animation-delay: 0.5s"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="glass-effect p-8 rounded-2xl group-hover:scale-105 transition-transform duration-300">
                        <div class="text-5xl font-bold text-yellow-400 mb-2" data-target="60">0</div>
                        <p class="text-gray-300 font-medium">قاضي خبير</p>
                        <div class="w-full h-1 bg-gray-700 rounded mt-4">
                            <div class="h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded animate-pulse" style="animation-delay: 1s"></div>
                        </div>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="glass-effect p-8 rounded-2xl group-hover:scale-105 transition-transform duration-300">
                        <div class="text-5xl font-bold text-yellow-400 mb-2" data-target="99">0</div>
                        <p class="text-gray-300 font-medium">% معدل الرضا</p>
                        <div class="w-full h-1 bg-gray-700 rounded mt-4">
                            <div class="h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded animate-pulse" style="animation-delay: 1.5s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="arabic-title text-5xl font-bold text-white mb-6">خدماتنا المتطورة</h3>
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 mx-auto mb-6"></div>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">تقنيات حديثة لتقديم أفضل الخدمات القضائية الرقمية</p>
            </div>
            
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                <!-- Service Cards -->
                <div class="service-card p-8 rounded-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="hexagon">
                            <i class="fas fa-cloud-upload-alt text-black text-xl"></i>
                        </div>
                        <span class="text-yellow-400 text-sm font-bold">جديد</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">رفع الطعون إلكترونياً</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">نظام متطور لرفع وتتبع الطعون مع إمكانية رفع المستندات بتقنية التشفير المتقدم</p>
                    <a href="/register" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        ابدأ الآن
                        <i class="fas fa-arrow-left mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="hexagon">
                            <i class="fas fa-search-plus text-black text-xl"></i>
                        </div>
                        <span class="text-green-400 text-sm font-bold">مُحدث</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">تتبع القضايا الذكي</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">نظام ذكي لمتابعة القضايا مع إشعارات فورية وتحديثات تلقائية</p>
                    <a href="/register" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        ابدأ الآن
                        <i class="fas fa-arrow-left mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="hexagon">
                            <i class="fas fa-certificate text-black text-xl"></i>
                        </div>
                        <span class="text-purple-400 text-sm font-bold">آمن</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">الشهادات الرقمية</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">استخراج الشهادات والوثائق القضائية مع ختم رقمي معتمد</p>
                    <a href="/register" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        ابدأ الآن
                        <i class="fas fa-arrow-left mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="hexagon">
                            <i class="fas fa-bolt text-black text-xl"></i>
                        </div>
                        <span class="text-red-400 text-sm font-bold">سريع</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">المعالجة العاجلة</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">خدمة سريعة للطلبات العاجلة مع ضمان المعالجة خلال ساعات</p>
                    <a href="/register" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        ابدأ الآن
                        <i class="fas fa-arrow-left mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="hexagon">
                            <i class="fas fa-calendar-check text-black text-xl"></i>
                        </div>
                        <span class="text-blue-400 text-sm font-bold">ذكي</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">إدارة الجلسات</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">نظام ذكي لجدولة الجلسات مع تقنية الذكاء الاصطناعي</p>
                    <a href="/register" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        ابدأ الآن
                        <i class="fas fa-arrow-left mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="hexagon">
                            <i class="fas fa-mobile-alt text-black text-xl"></i>
                        </div>
                        <span class="text-teal-400 text-sm font-bold">محمول</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">الدفع المحمول</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">حلول دفع متطورة مع دعم جميع وسائل الدفع الإلكتروني</p>
                    <a href="/register" class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        ابدأ الآن
                        <i class="fas fa-arrow-left mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="arabic-title text-5xl font-bold text-white mb-8">تاريخ عريق، مستقبل رقمي</h3>
                    <div class="space-y-6 text-gray-300 text-lg leading-relaxed">
                        <p>
                            منذ تأسيسها عام 1931، تقف محكمة النقض المصرية كحارسة للعدالة وضمانة لسيادة القانون في مصر.
                        </p>
                        <p>
                            اليوم، نخطو خطوات جريئة نحو المستقبل الرقمي، مستخدمين أحدث التقنيات لضمان وصول العدالة للجميع بكفاءة وشفافية لا مثيل لها.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 mt-10">
                        <div class="glass-effect p-6 rounded-xl text-center">
                            <div class="text-3xl font-bold text-yellow-400 mb-2">1931</div>
                            <div class="text-gray-300">سنة التأسيس</div>
                        </div>
                        <div class="glass-effect p-6 rounded-xl text-center">
                            <div class="text-3xl font-bold text-yellow-400 mb-2">8</div>
                            <div class="text-gray-300">دوائر متخصصة</div>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2 text-center">
                    <div class="glass-effect p-12 rounded-3xl transform hover:scale-105 transition-transform duration-500">
                        <div class="mb-8">
                            <i class="fas fa-landmark text-8xl text-yellow-400"></i>
                        </div>
                        <h4 class="arabic-title text-3xl font-bold text-white mb-6">رؤيتنا</h4>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            أن نكون الرائد العالمي في تطبيق تقنيات العدالة الرقمية، مع الحفاظ على القيم الأصيلة للقضاء المصري
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="arabic-title text-5xl font-bold text-white mb-6">تواصل معنا</h3>
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 mx-auto mb-6"></div>
                <p class="text-xl text-gray-300">نحن في خدمتكم على مدار الساعة</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-effect p-8 rounded-2xl text-center group hover:border-yellow-400 transition-all duration-300">
                    <div class="hexagon mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-map-marker-alt text-black text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">موقعنا</h4>
                    <p class="text-gray-300 leading-relaxed">مجمع محاكم القاهرة الجديدة<br>العاصمة الإدارية الجديدة<br>جمهورية مصر العربية</p>
                </div>
                
                <div class="glass-effect p-8 rounded-2xl text-center group hover:border-yellow-400 transition-all duration-300">
                    <div class="hexagon mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-phone text-black text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">اتصل بنا</h4>
                    <p class="text-gray-300 leading-relaxed">+20 2 2794 9999<br>الخط الساخن: 16000<br>واتساب: +20 100 123 4567</p>
                </div>
                
                <div class="glass-effect p-8 rounded-2xl text-center group hover:border-yellow-400 transition-all duration-300">
                    <div class="hexagon mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-envelope text-black text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">راسلنا</h4>
                    <p class="text-gray-300 leading-relaxed">info@cassation-eg.gov<br>support@cassation-eg.gov<br>digital@cassation-eg.gov</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 glass-effect border-t border-yellow-400/20 relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-4 gap-8 mb-12">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-4 space-x-reverse mb-6">
                        <div class="hexagon">
                            <i class="fas fa-balance-scale text-black text-xl"></i>
                        </div>
                        <div>
                            <h4 class="arabic-title text-2xl font-bold text-white">محكمة النقض المصرية</h4>
                            <p class="text-yellow-400 text-sm">العدالة الرقمية للجميع</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                        نحو مستقبل رقمي للعدالة المصرية باستخدام أحدث التقنيات العالمية مع الحفاظ على التراث القضائي العريق
                    </p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#" class="w-12 h-12 glass-effect rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-black transition-all duration-300 group">
                            <i class="fab fa-facebook-f group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#" class="w-12 h-12 glass-effect rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-black transition-all duration-300 group">
                            <i class="fab fa-twitter group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#" class="w-12 h-12 glass-effect rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-black transition-all duration-300 group">
                            <i class="fab fa-linkedin-in group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#" class="w-12 h-12 glass-effect rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-black transition-all duration-300 group">
                            <i class="fab fa-youtube group-hover:scale-110 transition-transform"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h5 class="font-bold text-lg mb-6 text-white">الخدمات الرقمية</h5>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-2"></i>
                            رفع الطعون
                        </a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-2"></i>
                            تتبع القضايا
                        </a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-2"></i>
                            الشهادات الرقمية
                        </a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center">
                            <i class="fas fa-chevron-left text-xs ml-2"></i>
                            الدفع الإلكتروني
                        </a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-bold text-lg mb-6 text-white">ساعات العمل</h5>
                    <div class="space-y-3 text-gray-300">
                        <div class="flex justify-between items-center">
                            <span>الأحد - الخميس</span>
                            <span class="text-yellow-400">9:00 - 15:00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>الجمعة - السبت</span>
                            <span class="text-red-400">مغلق</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>الخدمات الرقمية</span>
                            <span class="text-green-400">24/7</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 glass-effect p-4 rounded-lg">
                        <div class="flex items-center text-yellow-400 mb-2">
                            <i class="fas fa-shield-alt ml-2"></i>
                            <span class="text-sm font-semibold">نظام آمن 100%</span>
                        </div>
                        <p class="text-xs text-gray-300">محمي بتقنيات التشفير المتقدمة</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-yellow-400/20 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-right">
                    <p class="text-gray-400 mb-4 md:mb-0">
                        &copy; 2024 محكمة النقض المصرية. جميع الحقوق محفوظة.
                    </p>
                    <div class="flex items-center space-x-6 space-x-reverse text-sm text-gray-400">
                        <a href="#" class="hover:text-yellow-400 transition-colors">الخصوصية</a>
                        <a href="#" class="hover:text-yellow-400 transition-colors">الشروط</a>
                        <a href="#" class="hover:text-yellow-400 transition-colors">المساعدة</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('active');
        }

        // Typing Effect
        const typingElement = document.getElementById('typing-text');
        const words = ['المصرية', 'الرقمية', 'المتطورة', 'العصرية'];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeEffect() {
            const currentWord = words[wordIndex];
            
            if (isDeleting) {
                typingElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typingElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }

            if (!isDeleting && charIndex === currentWord.length) {
                setTimeout(() => isDeleting = true, 2000);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
            }

            const typingSpeed = isDeleting ? 100 : 200;
            setTimeout(typeEffect, typingSpeed);
        }

        // Start typing effect
        typeEffect();

        // Particles Animation
        function createParticles() {
            const container = document.getElementById('particles-container');
            
            setInterval(() => {
                if (document.querySelectorAll('.particle').length < 10) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    particle.style.left = Math.random() * 100 + 'vw';
                    particle.style.width = (Math.random() * 3 + 1) + 'px';
                    particle.style.height = particle.style.width;
                    particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    
                    container.appendChild(particle);
                    
                    setTimeout(() => {
                        particle.remove();
                    }, 5000);
                }
            }, 300);
        }

        createParticles();

        // Statistics Counter
        function animateCounters() {
            const counters = document.querySelectorAll('[data-target]');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2500;
                const step = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current).toLocaleString('ar-EG');
                }, 16);
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.querySelector('[data-target]')) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe stats section
        const statsSection = document.querySelector('[data-target]')?.closest('section');
        if (statsSection) observer.observe(statsSection);

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = document.querySelector('.menu-toggle');
            
            if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                mobileMenu.classList.remove('active');
            }
        });

        // Parallax effect for floating orbs
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            document.querySelectorAll('.floating-orb').forEach((orb, index) => {
                orb.style.transform = `translateY(${rate * (index + 1) * 0.1}px)`;
            });
        });

        // Service cards stagger animation
        const serviceCards = document.querySelectorAll('.service-card');
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });
        });

        serviceCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            cardObserver.observe(card);
        });
    </script>
