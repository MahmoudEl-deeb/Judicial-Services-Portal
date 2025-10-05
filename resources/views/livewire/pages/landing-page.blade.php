<div class="bg-[#F8FAFC]" x-data="{ 
    mobileMenuOpen: false,
    activeSection: 'home',
    notifications: [
        'إعلان هام: تم تفعيل النظام الإلكتروني الجديد للخدمات القضائية',
        'يمكن الآن تقديم الطعون إلكترونياً عبر المنصة الرقمية',
        'تحديث: إضافة خدمة الاستعلام عن مواعيد الجلسات إلكترونياً'
    ],
    currentNotification: 0
}" 
x-init="setInterval(() => {
    currentNotification = (currentNotification + 1) % notifications.length;
}, 4000)"
@scroll.window="
    const sections = ['home', 'services', 'about', 'contact'];
    const current = sections.find(section => {
        const element = document.getElementById(section);
        if (element) {
            const rect = element.getBoundingClientRect();
            return rect.top <= 100 && rect.bottom >= 100;
        }
        return false;
    });
    if (current) activeSection = current;
">

    <!-- News Ticker -->
    <div class="gold-bg text-white py-3 overflow-hidden relative">
        <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#B8941F]"></div>
        <div class="container mx-auto px-4">
            <div class="flex items-center">
                <span class="bg-white gold-text px-4 py-1 rounded text-sm font-bold ml-4 shadow-md">
                    <i class="fas fa-bullhorn ml-1"></i>
                    إعلانات هامة
                </span>
                <div class="flex-1 overflow-hidden">
                    <p x-text="notifications[currentNotification]" 
                       class="whitespace-nowrap transition-all duration-1000 font-medium"></p>
                </div>
                <div class="flex space-x-1 mr-4">
                    <template x-for="(_, index) in notifications" :key="index">
                        <div class="w-2 h-2 rounded-full transition-all duration-300"
                             :class="index === currentNotification ? 'bg-white' : 'bg-white bg-opacity-50'"></div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#2D3748] to-[#4A5568] text-white py-24 hero-pattern" id="home">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="floating mb-10">
                <div class="w-32 h-32 mx-auto bg-gold-light rounded-full flex items-center justify-center shadow-2xl border-4 gold-border">
                    <i class="fas fa-balance-scale-right gold-text text-6xl"></i>
                </div>
            </div>
            <h2 class="text-5xl font-bold mb-6 leading-tight">محكمة النقض المصرية</h2>
            <div class="section-divider w-48 mx-auto my-6"></div>
            <p class="text-xl mb-10 max-w-3xl mx-auto leading-relaxed text-gray-200">
                أعلى محكمة في النظام القضائي المصري - تختص برقابة صحة تطبيق القانون في المواد المدنية والتجارية والجنائية
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 sm:space-x-reverse">
                <a href="/register" class="group bg-gold-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-[#B8941F] transition-all transform hover:scale-105 shadow-2xl flex items-center">
                    <i class="fas fa-user-plus ml-3 transition-transform group-hover:scale-110"></i>
                    ابدأ الآن - إنشاء حساب
                </a>
                <a href="#services" class="group border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-[#2D3748] transition-all duration-300 flex items-center">
                    <i class="fas fa-arrow-down ml-3 transition-transform group-hover:translate-y-1"></i>
                    اكتشف الخدمات
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold grey-dark-text mb-4">إحصائيات المحكمة</h3>
                <div class="section-divider w-32 mx-auto"></div>
                <p class="text-xl grey-light-text max-w-2xl mx-auto mt-6">أرقام وحقائق تعكس حجم العمل والإنجازات في محكمة النقض</p>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="card-hover p-8 rounded-2xl text-center bg-white" 
                     x-data="{ count: 0, target: 15600 }" 
                     x-init="
                        $watch('activeSection', value => {
                            if (value === 'home' && count === 0) {
                                let start = 0;
                                const duration = 2500;
                                const step = target / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= target) {
                                        start = target;
                                        clearInterval(timer);
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }
                        })">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gold-light rounded-full flex items-center justify-center border-2 gold-border">
                        <i class="fas fa-gavel gold-text text-2xl"></i>
                    </div>
                    <div x-text="count.toLocaleString('ar-EG')" class="stats-counter text-4xl mb-2"></div>
                    <p class="grey-medium-text font-medium">قضية سنوياً</p>
                </div>
                
                <div class="card-hover p-8 rounded-2xl text-center bg-white" 
                     x-data="{ count: 0, target: 920 }" 
                     x-init="
                        $watch('activeSection', value => {
                            if (value === 'home' && count === 0) {
                                let start = 0;
                                const duration = 2500;
                                const step = target / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= target) {
                                        start = target;
                                        clearInterval(timer);
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }
                        })">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gold-light rounded-full flex items-center justify-center border-2 gold-border">
                        <i class="fas fa-user-tie gold-text text-2xl"></i>
                    </div>
                    <div x-text="count.toLocaleString('ar-EG')" class="stats-counter text-4xl mb-2"></div>
                    <p class="grey-medium-text font-medium">محامي مسجل</p>
                </div>
                
                <div class="card-hover p-8 rounded-2xl text-center bg-white" 
                     x-data="{ count: 0, target: 48 }" 
                     x-init="
                        $watch('activeSection', value => {
                            if (value === 'home' && count === 0) {
                                let start = 0;
                                const duration = 2500;
                                const step = target / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= target) {
                                        start = target;
                                        clearInterval(timer);
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }
                        })">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gold-light rounded-full flex items-center justify-center border-2 gold-border">
                        <i class="fas fa-balance-scale gold-text text-2xl"></i>
                    </div>
                    <div x-text="count.toLocaleString('ar-EG')" class="stats-counter text-4xl mb-2"></div>
                    <p class="grey-medium-text font-medium">قاضي</p>
                </div>
                
                <div class="card-hover p-8 rounded-2xl text-center bg-white" 
                     x-data="{ count: 0, target: 96 }" 
                     x-init="
                        $watch('activeSection', value => {
                            if (value === 'home' && count === 0) {
                                let start = 0;
                                const duration = 2500;
                                const step = target / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= target) {
                                        start = target;
                                        clearInterval(timer);
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }
                        })">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gold-light rounded-full flex items-center justify-center border-2 gold-border">
                        <i class="fas fa-chart-line gold-text text-2xl"></i>
                    </div>
                    <div x-text="count + '%'" class="stats-counter text-4xl mb-2"></div>
                    <p class="grey-medium-text font-medium">رضا المستخدمين</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-[#F1F5F9]" id="services">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold grey-dark-text mb-4">الخدمات الإلكترونية</h3>
                <div class="section-divider w-32 mx-auto"></div>
                <p class="text-xl grey-light-text max-w-2xl mx-auto mt-6">نوفر مجموعة متكاملة من الخدمات القضائية الرقمية لتسهيل الإجراءات وتوفير الوقت والجهد</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="card-hover bg-white p-8 rounded-2xl" 
                     x-data="{ hover: false }"
                     @mouseenter="hover = true"
                     @mouseleave="hover = false">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 shadow-md"
                         :class="hover ? 'gold-bg scale-110' : 'bg-gold-light'">
                        <i class="fas fa-file-upload text-2xl transition-all duration-300"
                           :class="hover ? 'text-white scale-110' : 'gold-text'"></i>
                    </div>
                    <h4 class="text-xl font-bold grey-dark-text mb-4">تقديم طعن بالنقض</h4>
                    <p class="grey-medium-text mb-6 leading-relaxed">تقديم الطعون إلكترونياً مع رفع المستندات المطلوبة وتتبع حالة الطعن بشكل مباشر</p>
                    <a href="/register" class="gold-text font-bold hover:text-[#B8941F] transition-colors flex items-center group">
                        ابدأ الخدمة
                        <i class="fas fa-arrow-left mr-2 transition-transform group-hover:-translate-x-1"></i>
                    </a>
                </div>
                
                <!-- Service Card 2 -->
                <div class="card-hover bg-white p-8 rounded-2xl" 
                     x-data="{ hover: false }"
                     @mouseenter="hover = true"
                     @mouseleave="hover = false">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 shadow-md"
                         :class="hover ? 'gold-bg scale-110' : 'bg-gold-light'">
                        <i class="fas fa-search text-2xl transition-all duration-300"
                           :class="hover ? 'text-white scale-110' : 'gold-text'"></i>
                    </div>
                    <h4 class="text-xl font-bold grey-dark-text mb-4">الاستعلام عن القضايا</h4>
                    <p class="grey-medium-text mb-6 leading-relaxed">متابعة حالة القضايا ومعرفة مواعيد الجلسات والأحكام الصادرة بشكل فوري</p>
                    <a href="/register" class="gold-text font-bold hover:text-[#B8941F] transition-colors flex items-center group">
                        ابدأ الخدمة
                        <i class="fas fa-arrow-left mr-2 transition-transform group-hover:-translate-x-1"></i>
                    </a>
                </div>
                
                <!-- Service Card 3 -->
                <div class="card-hover bg-white p-8 rounded-2xl" 
                     x-data="{ hover: false }"
                     @mouseenter="hover = true"
                     @mouseleave="hover = false">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 shadow-md"
                         :class="hover ? 'gold-bg scale-110' : 'bg-gold-light'">
                        <i class="fas fa-certificate text-2xl transition-all duration-300"
                           :class="hover ? 'text-white scale-110' : 'gold-text'"></i>
                    </div>
                    <h4 class="text-xl font-bold grey-dark-text mb-4">الحصول على الشهادات</h4>
                    <p class="grey-medium-text mb-6 leading-relaxed">استخراج صور طبق الأصل من الأحكام والشهادات القضائية بشكل إلكتروني</p>
                    <a href="/register" class="gold-text font-bold hover:text-[#B8941F] transition-colors flex items-center group">
                        ابدأ الخدمة
                        <i class="fas fa-arrow-left mr-2 transition-transform group-hover:-translate-x-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="/services" class="inline-flex items-center gold-text border-2 gold-border px-8 py-3 rounded-xl font-bold hover:bg-gold-light transition-all duration-300">
                    <span>عرض جميع الخدمات</span>
                    <i class="fas fa-arrow-left mr-3"></i>
                </a>
            </div>
        </div>
    </section>

 <!-- How It Works Section -->
<section class="py-20 bg-gradient-to-b from-white to-[#F8FAFC]" id="how-it-works">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h3 class="text-4xl font-bold grey-dark-text mb-4">كيفية استخدام النظام</h3>
            <div class="section-divider w-32 mx-auto"></div>
            <p class="text-xl grey-light-text max-w-2xl mx-auto mt-6">خطوات بسيطة ومباشرة للاستفادة من خدماتنا الإلكترونية المتطورة</p>
        </div>
        
        <!-- Steps Timeline -->
        <div class="relative">
            <!-- Connecting Line -->
            <div class="hidden lg:block absolute top-24 left-1/2 transform -translate-x-1/2 w-3/4 h-1 bg-gradient-to-r from-[#D4AF37] to-[#B8941F] rounded-full"></div>
            
            <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- Step 1 -->
                <div class="relative text-center lg:text-right" 
                     x-data="{ hover: false }"
                     @mouseenter="hover = true"
                     @mouseleave="hover = false">
                    <div class="relative mb-8">
                        <!-- Step Number with Icon -->
                        <div class="relative w-28 h-28 mx-auto lg:mx-0 gold-bg text-white rounded-2xl flex items-center justify-center text-3xl font-bold transition-all duration-500 shadow-xl"
                             :class="hover ? 'scale-110 rotate-3 shadow-2xl' : ''">
                            <span class="text-4xl">1</span>
                            <!-- Floating Icon -->
                            <div class="absolute -top-3 -right-3 w-12 h-12 bg-white rounded-full flex items-center justify-center gold-text border-4 border-[#F8FAFC] shadow-lg">
                                <i class="fas fa-user-plus text-lg"></i>
                            </div>
                        </div>
                        <!-- Connecting Dot for Mobile -->
                        <div class="lg:hidden absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-gold-primary rounded-full border-4 border-white shadow-md"></div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300"
                         :class="hover ? 'border-gold-primary shadow-xl' : ''">
                        <h4 class="text-xl font-bold grey-dark-text mb-3 transition-colors"
                            :class="hover ? 'gold-text' : ''">إنشاء حساب</h4>
                        <p class="grey-medium-text leading-relaxed text-right">
                            سجل حسابك الجديد كمحامي أو متقاضي مع رفع المستندات المطلوبة للتحقق والموافقة
                        </p>
                        <div class="mt-4 flex justify-end">
                            <span class="text-xs gold-text bg-gold-light px-3 py-1 rounded-full font-medium">
                                مدة التنفيذ: 24 ساعة
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="relative text-center" 
                     x-data="{ hover: false }"
                     @mouseenter="hover = true"
                     @mouseleave="hover = false">
                    <div class="relative mb-8">
                        <!-- Step Number with Icon -->
                        <div class="relative w-28 h-28 mx-auto gold-bg text-white rounded-2xl flex items-center justify-center text-3xl font-bold transition-all duration-500 shadow-xl"
                             :class="hover ? 'scale-110 -rotate-3 shadow-2xl' : ''">
                            <span class="text-4xl">2</span>
                            <!-- Floating Icon -->
                            <div class="absolute -top-3 -right-3 w-12 h-12 bg-white rounded-full flex items-center justify-center gold-text border-4 border-[#F8FAFC] shadow-lg">
                                <i class="fas fa-tasks text-lg"></i>
                            </div>
                        </div>
                        <!-- Connecting Dot for Mobile -->
                        <div class="lg:hidden absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-gold-primary rounded-full border-4 border-white shadow-md"></div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300"
                         :class="hover ? 'border-gold-primary shadow-xl' : ''">
                        <h4 class="text-xl font-bold grey-dark-text mb-3 transition-colors"
                            :class="hover ? 'gold-text' : ''">اختر الخدمة</h4>
                        <p class="grey-medium-text leading-relaxed text-center">
                            حدد الخدمة المطلوبة من القائمة واملأ النموذج الإلكتروني مع رفع الوثائق المطلوبة
                        </p>
                        <div class="mt-4 flex justify-center">
                            <span class="text-xs gold-text bg-gold-light px-3 py-1 rounded-full font-medium">
                                فوري
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="relative text-center lg:text-left" 
                     x-data="{ hover: false }"
                     @mouseenter="hover = true"
                     @mouseleave="hover = false">
                    <div class="relative mb-8">
                        <!-- Step Number with Icon -->
                        <div class="relative w-28 h-28 mx-auto lg:mx-0 gold-bg text-white rounded-2xl flex items-center justify-center text-3xl font-bold transition-all duration-500 shadow-xl"
                             :class="hover ? 'scale-110 rotate-3 shadow-2xl' : ''">
                            <span class="text-4xl">3</span>
                            <!-- Floating Icon -->
                            <div class="absolute -top-3 -right-3 w-12 h-12 bg-white rounded-full flex items-center justify-center gold-text border-4 border-[#F8FAFC] shadow-lg">
                                <i class="fas fa-chart-line text-lg"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300"
                         :class="hover ? 'border-gold-primary shadow-xl' : ''">
                        <h4 class="text-xl font-bold grey-dark-text mb-3 transition-colors"
                            :class="hover ? 'gold-text' : ''">تتبع الطلب</h4>
                        <p class="grey-medium-text leading-relaxed text-left">
                            تابع حالة طلبك بشكل مباشر واستلم الإشعارات والنتائج إلكترونياً عبر المنصة
                        </p>
                        <div class="mt-4 flex justify-start">
                            <span class="text-xs gold-text bg-gold-light px-3 py-1 rounded-full font-medium">
                                متابعة مستمرة
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Info Cards -->
        <div class="grid md:grid-cols-2 gap-8 mt-16">
            <!-- Benefits Card -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-l-4 gold-border">
                <div class="flex items-start space-x-4 space-x-reverse">
                    <div class="w-12 h-12 gold-bg rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-star text-white text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold grey-dark-text mb-3">مزايا النظام الإلكتروني</h4>
                        <ul class="grey-medium-text space-y-2 text-right">
                            <li class="flex items-center justify-end">
                                <span class="mr-2">توفير الوقت والجهد</span>
                                <i class="fas fa-check-circle gold-text"></i>
                            </li>
                            <li class="flex items-center justify-end">
                                <span class="mr-2">متابعة فورية للحالات</span>
                                <i class="fas fa-check-circle gold-text"></i>
                            </li>
                            <li class="flex items-center justify-end">
                                <span class="mr-2">تقليل التكاليف</span>
                                <i class="fas fa-check-circle gold-text"></i>
                            </li>
                            <li class="flex items-center justify-end">
                                <span class="mr-2">خدمة 24/7</span>
                                <i class="fas fa-check-circle gold-text"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Support Card -->
            <div class="bg-gradient-to-br from-[#2D3748] to-[#4A5568] p-8 rounded-2xl shadow-lg text-white">
                <div class="flex items-start space-x-4 space-x-reverse">
                    <div class="w-12 h-12 gold-bg rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-headset text-white text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-3">الدعم الفني</h4>
                        <p class="text-gray-200 mb-4 text-right">
                            فريق الدعم الفني جاهز لمساعدتك في أي استفسار أو مشكلة تواجهك خلال استخدام النظام
                        </p>
                        <div class="flex items-center justify-end space-x-4 space-x-reverse">
                            <div class="text-center">
                                <div class="gold-text text-2xl font-bold">19991</div>
                                <div class="text-gray-300 text-sm">الخط الساخن</div>
                            </div>
                            <div class="text-center">
                                <div class="gold-text text-lg font-bold">24/7</div>
                                <div class="text-gray-300 text-sm">خدمة مستمرة</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="text-center mt-12">
            <div class="bg-gold-light border-2 gold-border rounded-2xl p-8 max-w-2xl mx-auto">
                <h4 class="text-2xl font-bold grey-dark-text mb-4">جاهز للبدء؟</h4>
                <p class="grey-medium-text mb-6 text-lg">
                    انضم إلى آلاف المحامين والمتقاضين الذين يستخدمون نظامنا الإلكتروني
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 sm:space-x-reverse">
                    <a href="/register" class="gold-bg text-white px-8 py-3 rounded-xl font-bold hover:bg-[#B8941F] transition-all duration-300 shadow-lg flex items-center">
                        <i class="fas fa-rocket ml-2"></i>
                        إنشاء حساب جديد
                    </a>
                    <a href="/guide" class="border-2 gold-border gold-text px-8 py-3 rounded-xl font-bold hover:bg-gold-light transition-all duration-300 flex items-center">
                        <i class="fas fa-book ml-2"></i>
                        دليل الاستخدام
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
</div>