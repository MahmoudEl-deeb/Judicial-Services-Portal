<div>
<div x-data="lawyerDashboard()">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">لوحة تحكم المحامي</h1>
        <p class="text-lg text-gray-600">مرحباً بعودتك، {{ $user->first_name }}! إليك ملخص نشاطك المهني.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Service Requests -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">طلبات الخدمات</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2" x-text="stats.serviceRequests"></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-contract text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-arrow-up ml-1"></i>
                    <span x-text="stats.newServiceRequests"></span> طلبات جديدة
                </span>
            </div>
        </div>

        <!-- Active Cases -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">القضايا النشطة</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2" x-text="stats.activeCases"></p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-gavel text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-blue-600 font-medium">
                    قيد المتابعة
                </span>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">بانتظار الموافقة</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2" x-text="stats.pendingApprovals"></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-yellow-600 font-medium">
                    تحت المراجعة
                </span>
            </div>
        </div>

        <!-- Completed This Month -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">مكتملة هذا الشهر</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2" x-text="stats.completedThisMonth"></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-chart-line ml-1"></i>
                    +15% عن الشهر الماضي
                </span>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Activities -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">آخر الأنشطة</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">عرض الكل</a>
            </div>
            <div class="space-y-4">
                <!-- Activity 1 - Service Request -->
                <div class="flex items-start space-x-3 space-x-reverse p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-file-contract text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">تمت الموافقة على طلب الخدمة #SR-2024-0025</p>
                        <p class="text-xs text-gray-500 mt-1">طلب صورة رسمية من محضر الجلسة - القضية #C-2024-158</p>
                        <p class="text-xs text-gray-400 mt-1">منذ ساعتين</p>
                    </div>
                </div>

                <!-- Activity 2 - Case Update -->
                <div class="flex items-start space-x-3 space-x-reverse p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-gavel text-purple-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">جلسة جديدة في القضية #C-2024-156</p>
                        <p class="text-xs text-gray-500 mt-1">جلسة المرافعة - المحكمة الابتدائية</p>
                        <p class="text-xs text-gray-400 mt-1">منذ 5 ساعات</p>
                    </div>
                </div>

                <!-- Activity 3 - Document Request -->
                <div class="flex items-start space-x-3 space-x-reverse p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">طلب مستندات إضافية للقضية #C-2024-159</p>
                        <p class="text-xs text-gray-500 mt-1">يرجى رفع نسخ من المستندات الداعمة</p>
                        <p class="text-xs text-gray-400 mt-1">منذ يوم واحد</p>
                    </div>
                </div>

                <!-- Activity 4 - Payment -->
                <div class="flex items-start space-x-3 space-x-reverse p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-credit-card text-green-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">تم سداد رسوم الطلب #SR-2024-0023</p>
                        <p class="text-xs text-gray-500 mt-1">رسوم طلب الإشهاد - 350 جنيه</p>
                        <p class="text-xs text-gray-400 mt-1">منذ يومين</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">إجراءات سريعة</h2>
            <div class="grid grid-cols-1 gap-4">
                <!-- New Service Request -->
                <a href="#" class="flex items-center justify-between p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-300 group transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-file-contract text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">طلب خدمة جديدة</p>
                            <p class="text-sm text-gray-600">تقديم طلب خدمة قضائية</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                </a>

                <!-- My Cases -->
                <a href="#" class="flex items-center justify-between p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-all duration-300 group transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-gavel text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">قضاياي</p>
                            <p class="text-sm text-gray-600">عرض وإدارة القضايا</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-purple-600 transition-colors"></i>
                </a>

                <!-- Service Requests -->
                <a href="#" class="flex items-center justify-between p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-300 group transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-list text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">طلبات الخدمات</p>
                            <p class="text-sm text-gray-600">عرض جميع طلبات الخدمات</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-green-600 transition-colors"></i>
                </a>

                <!-- Documents -->
                <a href="#" class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-all duration-300 group transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center ml-3">
                            <i class="fas fa-folder-open text-white"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">المستندات</p>
                            <p class="text-sm text-gray-600">إدارة المستندات والمرفقات</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-left text-gray-400 group-hover:text-orange-600 transition-colors"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Service Requests & Cases Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Service Requests -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">أحدث طلبات الخدمات</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">عرض الكل</a>
            </div>
            <div class="space-y-4">
                <template x-for="request in serviceRequests" :key="request.id">
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-all duration-300">
                        <div class="flex items-center">
                            <div :class="`w-10 h-10 ${request.statusColor} rounded-full flex items-center justify-center ml-3`">
                                <i :class="`${request.icon} ${request.iconColor} text-sm`"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800" x-text="request.number"></p>
                                <p class="text-sm text-gray-600" x-text="request.type"></p>
                                <p class="text-xs text-gray-500 mt-1" x-text="request.case"></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span :class="`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${request.badgeColor}`" 
                                  x-text="request.status"></span>
                            <p class="text-sm text-gray-600 mt-1" x-text="request.date"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Recent Cases -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">أحدث القضايا</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">عرض الكل</a>
            </div>
            <div class="space-y-4">
                <template x-for="caseItem in recentCases" :key="caseItem.id">
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition-all duration-300">
                        <div class="flex items-center">
                            <div :class="`w-10 h-10 ${caseItem.statusColor} rounded-full flex items-center justify-center ml-3`">
                                <i class="fas fa-gavel text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800" x-text="caseItem.number"></p>
                                <p class="text-sm text-gray-600" x-text="caseItem.type"></p>
                                <p class="text-xs text-gray-500 mt-1" x-text="caseItem.court"></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span :class="`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${caseItem.badgeColor}`" 
                                  x-text="caseItem.status"></span>
                            <p class="text-sm text-gray-600 mt-1" x-text="caseItem.nextSession"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Upcoming Hearings & Professional Info -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Upcoming Hearings -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">الجلسات القادمة</h2>
            <div class="space-y-4">
                <template x-for="hearing in upcomingHearings" :key="hearing.id">
                    <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center ml-3">
                                <i class="fas fa-calendar-alt text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800" x-text="hearing.caseNumber"></p>
                                <p class="text-sm text-gray-600" x-text="hearing.type"></p>
                                <p class="text-xs text-gray-500 mt-1" x-text="hearing.court"></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800" x-text="hearing.date"></p>
                            <p class="text-sm text-gray-600" x-text="hearing.time"></p>
                            <p class="text-xs text-gray-500 mt-1" x-text="hearing.hall"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Professional Information -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">المعلومات المهنية</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 border-b border-gray-200">
                    <span class="text-sm font-medium text-gray-700">رقم القيد بالنقابة</span>
                    <span class="text-sm text-gray-900">{{ $user->bar_registration_number }}</span>
                </div>
                <div class="flex items-center justify-between p-3 border-b border-gray-200">
                    <span class="text-sm font-medium text-gray-700">التخصص</span>
                    <span class="text-sm text-gray-900">{{ $user->specialization }}</span>
                </div>
                <div class="flex items-center justify-between p-3 border-b border-gray-200">
                    <span class="text-sm font-medium text-gray-700">سنوات الخبرة</span>
                    <span class="text-sm text-gray-900">8 سنوات</span>
                </div>
                <div class="flex items-center justify-between p-3">
                    <span class="text-sm font-medium text-gray-700">تاريخ الانضمام</span>
                    <span class="text-sm text-gray-900">يناير 2020</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('profile.show') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                    تعديل الملف الشخصي
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function lawyerDashboard() {
    return {
        stats: {
            serviceRequests: 24,
            activeCases: 18,
            pendingApprovals: 7,
            completedThisMonth: 12,
            newServiceRequests: 5
        },
        serviceRequests: [
            {
                id: 1,
                number: '#SR-2024-0025',
                type: 'طلب صورة رسمية',
                case: 'القضية #C-2024-158',
                status: 'مقبول',
                badgeColor: 'bg-green-100 text-green-800',
                statusColor: 'bg-green-500',
                icon: 'fas fa-check',
                iconColor: 'text-white',
                date: '15/12/2024'
            },
            {
                id: 2,
                number: '#SR-2024-0024',
                type: 'طلب توثيق حكم',
                case: 'القضية #C-2024-156',
                status: 'قيد المعالجة',
                badgeColor: 'bg-purple-100 text-purple-800',
                statusColor: 'bg-purple-500',
                icon: 'fas fa-cogs',
                iconColor: 'text-white',
                date: '14/12/2024'
            },
            {
                id: 3,
                number: '#SR-2024-0023',
                type: 'طلب إشهاد',
                case: 'القضية #C-2024-159',
                status: 'بانتظار الدفع',
                badgeColor: 'bg-yellow-100 text-yellow-800',
                statusColor: 'bg-yellow-500',
                icon: 'fas fa-clock',
                iconColor: 'text-white',
                date: '13/12/2024'
            }
        ],
        recentCases: [
            {
                id: 1,
                number: '#C-2024-158',
                type: 'قضية تجارية',
                court: 'محكمة الاستئناف',
                status: 'جاري',
                badgeColor: 'bg-blue-100 text-blue-800',
                statusColor: 'bg-blue-500',
                nextSession: '20/12/2024'
            },
            {
                id: 2,
                number: '#C-2024-156',
                type: 'قضية مدنية',
                court: 'المحكمة الابتدائية',
                status: 'جاري',
                badgeColor: 'bg-blue-100 text-blue-800',
                statusColor: 'bg-blue-500',
                nextSession: '18/12/2024'
            },
            {
                id: 3,
                number: '#C-2024-159',
                type: 'قضية جنائية',
                court: 'محكمة الجنايات',
                status: 'قيد المراجعة',
                badgeColor: 'bg-yellow-100 text-yellow-800',
                statusColor: 'bg-yellow-500',
                nextSession: '22/12/2024'
            }
        ],
        upcomingHearings: [
            {
                id: 1,
                caseNumber: '#C-2024-156',
                type: 'جلسة مرافعة',
                court: 'المحكمة الابتدائية',
                date: '18/12/2024',
                time: '10:00 ص',
                hall: 'القاعة 3'
            },
            {
                id: 2,
                caseNumber: '#C-2024-158',
                type: 'جلسة استماع',
                court: 'محكمة الاستئناف',
                date: '20/12/2024',
                time: '11:30 ص',
                hall: 'القاعة 1'
            }
        ]
    }
}
</script>

<style>
/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, transform, box-shadow;
    transition-duration: 300ms;
}
</style>
</div>