
<div class="bg-gray-50" x-data="{ 
    mobileMenuOpen: false,
    activeSection: 'home',
    notifications: [
        'إعلان هام: تم تفعيل نظام الخدمات الإلكترونية الجديد',
        'يمكن الآن تقديم الطعون إلكترونياً',
        'تحديث مواعيد الجلسات متاح على الموقع'
    ],
    currentNotification: 0
}" 
x-init="setInterval(() => {
    currentNotification = (currentNotification + 1) % notifications.length;
}, 3000)"
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
    <div class="bg-red-600 text-white py-2 overflow-hidden">
        <div class="container mx-auto">
            <div class="flex items-center">
                <span class="bg-white text-red-600 px-3 py-1 rounded text-sm font-bold ml-4">عاجل</span>
                <div class="flex-1 overflow-hidden">
                    <p x-text="notifications[currentNotification]" class="whitespace-nowrap transition-all duration-500"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="gradient-bg hero-pattern text-white py-20" id="home">
        <div class="container mx-auto px-4 text-center">
            <div class="floating mb-8">
                <i class="fas fa-gavel text-8xl scale-icon mb-6"></i>
            </div>
            <h2 class="text-5xl font-bold mb-6">محكمة النقض المصرية</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto leading-relaxed">
                أعلى محكمة في النظام القضائي المصري - نحو عدالة رقمية متطورة تخدم المواطنين والمحامين بكفاءة وشفافية عالية
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 sm:space-x-reverse">
                <a href="/register" class="bg-white text-blue-800 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-user-plus ml-2"></i>
                    ابدأ الآن - إنشاء حساب
                </a>
                <a href="#services" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-800 transition-all">
                    <i class="fas fa-info-circle ml-2"></i>
                    اكتشف الخدمات
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="card-hover p-6" x-data="{ count: 0, target: 15000 }" x-init="
                    $watch('activeSection', value => {
                        if (value === 'home' && count === 0) {
                            let start = 0;
                            const duration = 2000;
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
                    <div x-text="count.toLocaleString('ar-EG')" class="stats-counter"></div>
                    <p class="text-gray-600 font-medium">قضية سنوياً</p>
                </div>
                <div class="card-hover p-6" x-data="{ count: 0, target: 850 }" x-init="
                    $watch('activeSection', value => {
                        if (value === 'home' && count === 0) {
                            let start = 0;
                            const duration = 2000;
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
                    <div x-text="count.toLocaleString('ar-EG')" class="stats-counter"></div>
                    <p class="text-gray-600 font-medium">محامي مسجل</p>
                </div>
                <div class="card-hover p-6" x-data="{ count: 0, target: 45 }" x-init="
                    $watch('activeSection', value => {
                        if (value === 'home' && count === 0) {
                            let start = 0;
                            const duration = 2000;
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
                    <div x-text="count.toLocaleString('ar-EG')" class="stats-counter"></div>
                    <p class="text-gray-600 font-medium">قاضي</p>
                </div>
                <div class="card-hover p-6" x-data="{ count: 0, target: 98 }" x-init="
                    $watch('activeSection', value => {
                        if (value === 'home' && count === 0) {
                            let start = 0;
                            const duration = 2000;
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
                    <div x-text="count + '%'" class="stats-counter"></div>
                    <p class="text-gray-600 font-medium">% رضا المستخدمين</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-100" id="services">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-blue-800 mb-4">خدماتنا الإلكترونية</h3>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">نوفر مجموعة شاملة من الخدمات القضائية الرقمية لتسهيل إجراءاتكم</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Cards with Alpine.js hover effects -->
                <template x-for="(service, index) in [
                    { icon: 'file-upload', color: 'blue', title: 'تقديم طعن بالنقض', desc: 'تقديم الطعون إلكترونياً مع رفع المستندات المطلوبة وتتبع حالة الطعن' },
                    { icon: 'search', color: 'green', title: 'الاستعلام عن القضايا', desc: 'متابعة حالة قضاياك ومعرفة مواعيد الجلسات والأحكام الصادرة' },
                    { icon: 'certificate', color: 'purple', title: 'الحصول على الشهادات', desc: 'استخراج صور طبق الأصل من الأحكام والشهادات القضائية' },
                    { icon: 'clock', color: 'orange', title: 'الخدمات العاجلة', desc: 'معالجة سريعة للطلبات العاجلة مع رسوم إضافية' },
                    { icon: 'calendar-alt', color: 'red', title: 'جدولة الجلسات', desc: 'عرض جداول الجلسات وإشعارات المواعيد المهمة' },
                    { icon: 'credit-card', color: 'teal', title: 'الدفع الإلكتروني', desc: 'سداد الرسوم القضائية بطرق دفع آمنة ومتعددة' }
                ]" :key="index">
                    <div class="bg-white p-8 rounded-xl shadow-lg card-hover" 
                         x-data="{ hover: false }"
                         @mouseenter="hover = true"
                         @mouseleave="hover = false">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6 transition-all duration-300"
                             :class="hover ? 
                                 `bg-${service.color}-500 scale-110` : 
                                 `bg-${service.color}-100`">
                            <i :class="`fas fa-${service.icon} text-${service.color}-600 text-2xl transition-all duration-300`"
                               :class="hover ? 'text-white scale-110' : ''"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-4" x-text="service.title"></h4>
                        <p class="text-gray-600 mb-6" x-text="service.desc"></p>
                        <a href="/register" class="text-blue-600 font-bold hover:text-blue-800 transition-colors flex items-center">
                            ابدأ الآن <i class="fas fa-arrow-left mr-2 transition-transform" :class="hover ? 'mr-3' : 'mr-2'"></i>
                        </a>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-blue-800 mb-4">كيف يعمل النظام؟</h3>
                <p class="text-xl text-gray-600">خطوات بسيطة للاستفادة من خدماتنا الإلكترونية</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <template x-for="(step, index) in [
                    { number: 1, title: 'إنشاء حساب', desc: 'سجل حسابك الجديد كمحامي أو متقاضي مع رفع المستندات المطلوبة' },
                    { number: 2, title: 'اختر الخدمة', desc: 'حدد الخدمة المطلوبة واملأ النموذج المناسب مع رفع الوثائق' },
                    { number: 3, title: 'تتبع الطلب', desc: 'راقب حالة طلبك واستلم الإشعارات والنتائج إلكترونياً' }
                ]" :key="index">
                    <div class="text-center" x-data="{ hover: false }"
                         @mouseenter="hover = true"
                         @mouseleave="hover = false">
                        <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 transition-all duration-300"
                             :class="hover ? 'scale-110 bg-blue-700' : ''">
                            <span x-text="step.number"></span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-4 transition-colors"
                            :class="hover ? 'text-blue-600' : ''" x-text="step.title"></h4>
                        <p class="text-gray-600 transition-colors"
                           :class="hover ? 'text-gray-700' : ''" x-text="step.desc"></p>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-blue-50" id="about">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-4xl font-bold text-blue-800 mb-6">عن محكمة النقض المصرية</h3>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        محكمة النقض هي أعلى محكمة في النظام القضائي المصري، تأسست عام 1931 وتختص بنظر الطعون في الأحكام النهائية الصادرة من محاكم الاستئناف والمحاكم الابتدائية في القضايا التي يحددها القانون.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        نسعى من خلال نظامنا الإلكتروني الجديد إلى تطوير العدالة الرقمية وتسهيل الوصول للخدمات القضائية مع ضمان الشفافية والكفاءة.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-3xl font-bold text-blue-600">1931</div>
                            <div class="text-gray-600">سنة التأسيس</div>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-3xl font-bold text-blue-600">6</div>
                            <div class="text-gray-600">دوائر متخصصة</div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-white rounded-2xl p-8 shadow-xl" x-data="{ hover: false }"
                         @mouseenter="hover = true"
                         @mouseleave="hover = false">
                        <i class="fas fa-building text-8xl text-blue-600 mb-6 transition-all duration-300"
                           :class="hover ? 'scale-110 text-blue-700' : ''"></i>
                        <h4 class="text-2xl font-bold text-gray-800 mb-4 transition-colors"
                            :class="hover ? 'text-blue-600' : ''">رؤيتنا</h4>
                        <p class="text-gray-600 transition-colors"
                           :class="hover ? 'text-gray-700' : ''">
                            أن نكون النموذج الرائد في تطبيق العدالة الرقمية والشفافية في النظام القضائي العربي
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-white" id="contact">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-blue-800 mb-4">اتصل بنا</h3>
                <p class="text-xl text-gray-600">نحن هنا لمساعدتك في جميع استفساراتك</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <template x-for="(contact, index) in [
                    { icon: 'map-marker-alt', color: 'blue', title: 'العنوان', desc: 'محكمة النقض - مجمع المحاكم<br>القاهرة، جمهورية مصر العربية' },
                    { icon: 'phone', color: 'green', title: 'الهاتف', desc: '+20 2 2794 1234<br>الخط الساخن: 19991' },
                    { icon: 'envelope', color: 'red', title: 'البريد الإلكتروني', desc: 'info@cassation.gov.eg<br>support@cassation.gov.eg' }
                ]" :key="index">
                    <div class="text-center p-8 bg-gray-50 rounded-lg" x-data="{ hover: false }"
                         @mouseenter="hover = true"
                         @mouseleave="hover = false">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 transition-all duration-300"
                             :class="hover ? 
                                 `bg-${contact.color}-500 scale-110` : 
                                 `bg-${contact.color}-100`">
                            <i :class="`fas fa-${contact.icon} text-${contact.color}-600 text-2xl transition-all duration-300`"
                               :class="hover ? 'text-white scale-110' : ''"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-4 transition-colors"
                            :class="hover ? `text-${contact.color}-600` : ''" x-text="contact.title"></h4>
                        <p class="text-gray-600 transition-colors"
                           :class="hover ? 'text-gray-700' : ''" x-html="contact.desc"></p>
                    </div>
                </template>
            </div>
        </div>
    </section>

 
{{-- </body>
</html> --}}
</div>