<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">لوحة تحكم المتقاضي</h1>
        <p class="text-lg text-gray-600">مرحباً بعودتك، {{ $user->first_name }}! إليك ملخص طلبات الخدمات الخاصة بك.</p>
    </div>

    <!-- Service Requests Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Requests Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">إجمالي الطلبات</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">15</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-arrow-up ml-1"></i>
                    3 طلبات جديدة
                </span>
            </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">قيد الانتظار</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">6</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-gray-600 font-medium">
                    بانتظار المراجعة
                </span>
            </div>
        </div>

        <!-- In Progress Requests Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">قيد المعالجة</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">5</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-cogs text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-blue-600 font-medium">
                    جاري العمل عليها
                </span>
            </div>
        </div>

        <!-- Completed Requests Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">مكتملة</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">4</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    تم الانتهاء منها
                </span>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Service Requests Activities -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">آخر أنشطة الطلبات</h2>
                <span class="text-sm text-blue-600 hover:text-blue-800 cursor-pointer">عرض الكل</span>
            </div>
            <div class="space-y-4">
                <!-- Activity 1 -->
                <div class="flex items-start space-x-3 space-x-reverse">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">تمت الموافقة على الطلب #SR-2024-0012</p>
                        <p class="text-xs text-gray-500 mt-1">طلب صورة رسمية من محضر الجلسة</p>
                        <p class="text-xs text-gray-400 mt-1">منذ 2 ساعة</p>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="flex items-start space-x-3 space-x-reverse">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-tie text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">تم تعيين أمين سر للطلب #SR-2024-0013</p>
                        <p class="text-xs text-gray-500 mt-1">طلب توثيق حكم قضائي</p>
                        <p class="text-xs text-gray-400 mt-1">منذ 5 ساعات</p>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="flex items-start space-x-3 space-x-reverse">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">طلب مستندات إضافية للطلب #SR-2024-0014</p>
                        <p class="text-xs text-gray-500 mt-1">يرجى رفع المستندات المطلوبة</p>
                        <p class="text-xs text-gray-400 mt-1">منذ يوم واحد</p>
                    </div>
                </div>

                <!-- Activity 4 -->
                <div class="flex items-start space-x-3 space-x-reverse">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-credit-card text-purple-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">طلب دفع رسوم الطلب #SR-2024-0015</p>
                        <p class="text-xs text-gray-500 mt-1">الرسوم المستحقة: 250 جنيه</p>
                        <p class="text-xs text-gray-400 mt-1">منذ يومين</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">إجراءات سريعة</h2>
            <div class="grid grid-cols-1 gap-4">
                <!-- New Service Request Button -->
                <a href="#" 
                   class="flex items-center justify-between p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-300 group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">طلب خدمة جديدة</p>
                            <p class="text-sm text-gray-600">تقديم طلب خدمة قضائية جديدة</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                </a>

                <!-- View Requests Button -->
                <a href="#" 
                   class="flex items-center justify-between p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-300 group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-list text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">عرض طلباتي</p>
                            <p class="text-sm text-gray-600">استعراض جميع طلبات الخدمات</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-green-600 transition-colors"></i>
                </a>

                <!-- Documents Button -->
                <a href="#" 
                   class="flex items-center justify-between p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-300 group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-file-upload text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">مستندات الطلبات</p>
                            <p class="text-sm text-gray-600">إدارة مستندات طلبات الخدمات</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-purple-600 transition-colors"></i>
                </a>

                <!-- Payments Button -->
                <a href="#" 
                   class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors duration-300 group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-credit-card text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">الدفعات والرسوم</p>
                            <p class="text-sm text-gray-600">عرض وإدارة المدفوعات</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-orange-600 transition-colors"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Service Requests -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-800">أحدث طلبات الخدمات</h2>
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800">عرض الكل</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">رقم الطلب</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">نوع الخدمة</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">القسم</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">الحالة</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">الأولوية</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">تاريخ الطلب</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Request 1 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">#SR-2024-0015</td>
                        <td class="px-4 py-3 text-sm text-gray-700">صورة رسمية من المحضر</td>
                        <td class="px-4 py-3 text-sm text-gray-700">القسم المدني</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                بانتظار الدفع
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                عادية
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">15/12/2024</td>
                        <td class="px-4 py-3">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>

                    <!-- Request 2 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">#SR-2024-0014</td>
                        <td class="px-4 py-3 text-sm text-gray-700">توثيق حكم قضائي</td>
                        <td class="px-4 py-3 text-sm text-gray-700">القسم التجاري</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                قيد المراجعة
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                عاجل
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">14/12/2024</td>
                        <td class="px-4 py-3">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                رفع مستندات
                            </button>
                        </td>
                    </tr>

                    <!-- Request 3 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">#SR-2024-0013</td>
                        <td class="px-4 py-3 text-sm text-gray-700">طلب إشهاد</td>
                        <td class="px-4 py-3 text-sm text-gray-700">القسم الجنائي</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                قيد المعالجة
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                عادية
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">12/12/2024</td>
                        <td class="px-4 py-3">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                متابعة
                            </button>
                        </td>
                    </tr>

                    <!-- Request 4 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">#SR-2024-0012</td>
                        <td class="px-4 py-3 text-sm text-gray-700">طلب صورة طبق الأصل</td>
                        <td class="px-4 py-3 text-sm text-gray-700">القسم المدني</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                مكتمل
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                عادية
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">10/12/2024</td>
                        <td class="px-4 py-3">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                تحميل المستند
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Status -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Pending Payments -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">الدفعات المعلقة</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-exclamation text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">الطلب #SR-2024-0015</p>
                            <p class="text-sm text-gray-600">صورة رسمية من المحضر</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">250 جنيه</p>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-1">
                            سداد الآن
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-clock text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">الطلب #SR-2024-0016</p>
                            <p class="text-sm text-gray-600">طلب إشهاد مستعجل</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">500 جنيه</p>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-1">
                            سداد الآن
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Types Overview -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">الخدمات الأكثر طلباً</h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">صورة رسمية من المحضر</span>
                    <span class="text-sm font-medium text-gray-800">8 طلبات</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">توثيق أحكام قضائية</span>
                    <span class="text-sm font-medium text-gray-800">5 طلبات</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">طلب إشهاد</span>
                    <span class="text-sm font-medium text-gray-800">3 طلبات</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">صورة طبق الأصل</span>
                    <span class="text-sm font-medium text-gray-800">2 طلب</span>
                </div>
            </div>
        </div>
    </div>
</div>
