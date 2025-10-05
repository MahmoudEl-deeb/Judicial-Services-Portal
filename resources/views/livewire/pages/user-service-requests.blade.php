<div>
<div class="min-h-screen bg-gradient-to-br from-[#f8f9fa] to-[#e9ecef] py-8">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-6 border border-[#d4af37]">
                <i class="fas fa-file-contract text-3xl text-[#8b7355]"></i>
            </div>
            <h1 class="text-4xl font-bold text-[#2c3e50] mb-4">طلبات الخدمات القضائية</h1>
            <p class="text-xl text-[#5d6d7e] max-w-2xl mx-auto">إدارة ومتابعة جميع طلبات الخدمات الخاصة بك في نظام محكمة النقض</p>
        </div>

        <!-- Alert Messages -->
        <div class="max-w-6xl mx-auto mb-8">
            @if (session()->has('error'))
                <div class="bg-red-50 border-r-4 border-red-500 rounded-l-xl p-6 shadow-sm mb-6 animate-fade-in border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400 text-2xl"></i>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-lg font-semibold text-red-800">خطأ في النظام</h3>
                            <p class="text-red-700 mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="bg-green-50 border-r-4 border-green-500 rounded-l-xl p-6 shadow-sm mb-6 animate-fade-in border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-lg font-semibold text-green-800">عملية ناجحة</h3>
                            <p class="text-green-700 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Main Content Card -->
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-[#d4af37]">
                <!-- Action Bar -->
                <div class="bg-gradient-to-r from-[#2c3e50] to-[#34495e] px-8 py-6 border-b border-[#d4af37]">
                    <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                        <div class="text-white">
                            <h2 class="text-2xl font-bold">لوحة التحكم بالطلبات</h2>
                            <p class="text-gray-300 mt-1">مرحباً بك في نظام إدارة الخدمات القضائية</p>
                        </div>
                        <a href="#" 
                           class="bg-[#d4af37] text-[#2c3e50] hover:bg-[#b8941f] font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl flex items-center gap-3 group">
                            <i class="fas fa-plus-circle text-lg"></i>
                            <span>طلب خدمة جديدة</span>
                            <i class="fas fa-arrow-left group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="p-8 border-b border-gray-200 bg-gradient-to-r from-[#f8f9fa] to-[#ecf0f1]">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Search -->
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-[#8b7355]"></i>
                            </div>
                            <input wire:model.live.debounce.300ms="searchQuery" 
                                   type="text" 
                                   placeholder="ابحث برقم الطلب، العنوان، أو نوع الخدمة..."
                                   class="w-full pr-12 pl-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all duration-300 bg-white">
                        </div>

                        <!-- Status Filter -->
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-filter text-[#8b7355]"></i>
                            </div>
                            <select wire:model.live="statusFilter"
                                    class="w-full pr-12 pl-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all duration-300 bg-white appearance-none">
                                <option value="">جميع حالات الطلبات</option>
                                <option value="pending">🟡 قيد الانتظار</option>
                                <option value="under_department_review">🔵 قيد مراجعة الدائرة</option>
                                <option value="in_progress">🟢 قيد التنفيذ</option>
                                <option value="completed">✅ مكتمل</option>
                                <option value="rejected">🔴 مرفوض</option>
                                <option value="awaiting_payment">🟣 في انتظار الدفع</option>
                            </select>
                        </div>

                        <!-- Items Per Page -->
                        <div class="flex items-center gap-4">
                            <div class="relative flex-1">
                                <select wire:model.live="perPage"
                                        class="w-full pr-12 pl-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] transition-all duration-300 bg-white appearance-none">
                                    <option value="6">6 عناصر</option>
                                    <option value="12">12 عنصر</option>
                                    <option value="18">18 عنصر</option>
                                    <option value="24">24 عنصر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="p-8 bg-gradient-to-r from-[#f8f9fa] to-[#ecf0f1] border-b border-gray-200">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white rounded-2xl p-6 shadow-lg border-r-4 border-[#2c3e50] hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">إجمالي الطلبات</p>
                                    <p class="text-3xl font-bold text-[#2c3e50] mt-2">{{ $this->totalCount }}</p>
                                </div>
                                <div class="w-14 h-14 bg-[#2c3e50] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-layer-group text-[#d4af37] text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg border-r-4 border-[#27ae60] hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">مكتملة</p>
                                    <p class="text-3xl font-bold text-[#2c3e50] mt-2">{{ $this->completedCount }}</p>
                                </div>
                                <div class="w-14 h-14 bg-[#27ae60] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-check-double text-white text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg border-r-4 border-[#d4af37] hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">قيد المعالجة</p>
                                    <p class="text-3xl font-bold text-[#2c3e50] mt-2">{{ $this->inProgressCount }}</p>
                                </div>
                                <div class="w-14 h-14 bg-[#d4af37] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-tasks text-white text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg border-r-4 border-[#8e44ad] hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">بانتظار الدفع</p>
                                    <p class="text-3xl font-bold text-[#2c3e50] mt-2">{{ $this->pendingPaymentCount }}</p>
                                </div>
                                <div class="w-14 h-14 bg-[#8e44ad] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-credit-card text-white text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Requests Grid -->
                <div class="p-8">
                    @if($serviceRequests->count() > 0)
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                        @foreach ($serviceRequests as $serviceRequest)
                        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-500 group border-r-4 border-[#d4af37]">
                            <!-- Card Header -->
                            <div class="relative bg-gradient-to-r from-[#f8f9fa] to-[#ecf0f1] px-6 py-5 border-b border-gray-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center border border-[#d4af37]">
                                            <i class="fas fa-file-contract text-[#8b7355] text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-[#2c3e50]">{{ $serviceRequest->service_type_name }}</h3>
                                            <p class="text-[#8b7355] font-medium text-sm">#{{ $serviceRequest->request_number }}</p>
                                        </div>
                                    </div>
                                    <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $serviceRequest->status_badge_class }} shadow-sm border border-gray-300">
                                        {{ $serviceRequest->status_ar }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <!-- Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Case Info -->
                                    <div class="flex items-center gap-4 p-4 bg-[#f8f9fa] rounded-xl border border-gray-200">
                                        <div class="w-10 h-10 bg-[#2c3e50] rounded-lg flex items-center justify-center">
                                            <i class="fas fa-gavel text-[#d4af37]"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">القضية المرتبطة</p>
                                            <p class="text-sm font-semibold text-[#2c3e50]">
                                                {{ $serviceRequest->case_number ?? 'غير مرتبط بقضية' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Department -->
                                    @if($serviceRequest->department_name)
                                    <div class="flex items-center gap-4 p-4 bg-[#f8f9fa] rounded-xl border border-gray-200">
                                        <div class="w-10 h-10 bg-[#27ae60] rounded-lg flex items-center justify-center">
                                            <i class="fas fa-building text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">القسم المختص</p>
                                            <p class="text-sm font-semibold text-[#2c3e50]">{{ $serviceRequest->department_name }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <!-- Timeline -->
                                <div class="flex items-center justify-between mb-6 p-4 bg-[#f8f9fa] rounded-xl border border-gray-200">
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">تاريخ الإنشاء</p>
                                        <p class="text-sm font-semibold text-[#2c3e50]">
                                            {{ \Carbon\Carbon::parse($serviceRequest->created_at)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    
                                    
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">موعد التسليم</p>
                                        <p class="text-sm font-semibold text-[#2c3e50]">
                                            {{ \Carbon\Carbon::parse(now()->addDays($serviceRequest->rest_days))->format('d/m/Y') }}
                                        </p>
                                    </div>
                                 
                                </div>

                                <!-- Payment & Documents -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <!-- Payment Status -->
                                    <div class="bg-gradient-to-r from-[#fff9e6] to-[#fcf3d3] rounded-xl p-4 border border-[#d4af37]">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-[#8b7355]">حالة الدفع</span>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $serviceRequest->payment_status_class }} border border-gray-300">
                                                {{ $serviceRequest->payment_status_ar }}
                                            </span>
                                        </div>
                                        @if($serviceRequest->total_fees_amount > 0)
                                        <div class="mt-2 text-right">
                                            <span class="text-lg font-bold text-[#2c3e50]">
                                                {{ number_format($serviceRequest->total_fees_amount, 2) }} ج.م
                                            </span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Documents -->
                                    <div class="bg-gradient-to-r from-[#f8f9fa] to-[#ecf0f1] rounded-xl p-4 border border-gray-300">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-700">المستندات</span>
                                            <span class="flex items-center gap-1 text-sm text-[#8b7355]">
                                                <i class="fas fa-paperclip"></i>
                                                {{ $serviceRequest->documents_count }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Actions -->
                            <div class="bg-gradient-to-r from-[#f8f9fa] to-[#ecf0f1] px-6 py-4 border-t border-gray-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        @if (auth()->user()->hasRole('lawyer') || auth()->user()->hasRole('litigant'))
                                        <a href="{{ route('service-request.details', base64_encode($serviceRequest->id) ) }}" 
                                           class="bg-white text-[#2c3e50] hover:bg-[#2c3e50] hover:text-white font-medium py-2 px-4 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2 group border border-gray-300">
                                            <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                            عرض التفاصيل
                                        </a>
                                        @endif
                                    </div>
                                    
                                    @if($serviceRequest->payment_status == 'pending' && $serviceRequest->total_fees_amount > 0)
                                    <a href="{{ route('payment', base64_encode($serviceRequest->id)) }}" 
                                       class="bg-gradient-to-r from-[#d4af37] to-[#b8941f] text-white hover:from-[#b8941f] hover:to-[#a3821a] font-bold py-2 px-5 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl flex items-center gap-2">
                                        <i class="fas fa-credit-card"></i>
                                        سداد الرسوم
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-32 h-32 bg-gradient-to-br from-[#f8f9fa] to-[#ecf0f1] rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg border border-[#d4af37]">
                                <i class="fas fa-file-contract text-5xl text-[#8b7355]"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-[#2c3e50] mb-4">لا توجد طلبات خدمات</h3>
                            <p class="text-gray-600 text-lg mb-8">لم تقم بتقديم أي طلبات خدمات حتى الآن. ابدأ برحلة الخدمات القضائية الآن!</p>
                            <a href="#" 
                               class="inline-flex items-center gap-3 bg-gradient-to-r from-[#2c3e50] to-[#34495e] text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                                <i class="fas fa-plus-circle"></i>
                                إنشاء طلب خدمة جديد
                                <i class="fas fa-arrow-left transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($serviceRequests->hasPages())
                    <div class="mt-12 bg-gradient-to-r from-[#f8f9fa] to-[#ecf0f1] rounded-2xl p-6 shadow-sm border border-gray-300">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="text-gray-600">
                                <p class="font-medium">عرض <span class="text-[#8b7355]">{{ $serviceRequests->firstItem() }}</span> إلى <span class="text-[#8b7355]">{{ $serviceRequests->lastItem() }}</span> من <span class="text-[#8b7355]">{{ $serviceRequests->total() }}</span> طلب</p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <!-- Previous Page -->
                                @if($serviceRequests->onFirstPage())
                                <span class="w-12 h-12 bg-gray-100 text-gray-400 rounded-xl flex items-center justify-center cursor-not-allowed border border-gray-300">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                                @else
                                <a href="{{ $serviceRequests->previousPageUrl() }}" 
                                   class="w-12 h-12 bg-white text-[#8b7355] border border-gray-300 rounded-xl hover:bg-[#8b7355] hover:text-white hover:border-[#8b7355] transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                                @endif

                                <!-- Page Numbers -->
                                @foreach($serviceRequests->getUrlRange(1, $serviceRequests->lastPage()) as $page => $url)
                                    @if($page == $serviceRequests->currentPage())
                                    <span class="w-12 h-12 bg-gradient-to-r from-[#2c3e50] to-[#34495e] text-white rounded-xl flex items-center justify-center font-bold shadow-lg border border-[#d4af37]">
                                        {{ $page }}
                                    </span>
                                    @else
                                    <a href="{{ $url }}" 
                                       class="w-12 h-12 bg-white text-gray-600 border border-gray-300 rounded-xl hover:bg-[#f8f9fa] hover:text-[#8b7355] hover:border-[#8b7355] transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                                        {{ $page }}
                                    </a>
                                    @endif
                                @endforeach

                                <!-- Next Page -->
                                @if($serviceRequests->hasMorePages())
                                <a href="{{ $serviceRequests->nextPageUrl() }}" 
                                   class="w-12 h-12 bg-white text-[#8b7355] border border-gray-300 rounded-xl hover:bg-[#8b7355] hover:text-white hover:border-[#8b7355] transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                @else
                                <span class="w-12 h-12 bg-gray-100 text-gray-400 rounded-xl flex items-center justify-center cursor-not-allowed border border-gray-300">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.group:hover .group-hover\:translate-x-1 {
    transform: translateX(-4px);
}

/* Gold and Gray Color Scheme */
.gold-bg { background-color: #d4af37; }
.gold-text { color: #d4af37; }
.gold-border { border-color: #d4af37; }
.gold-light { background-color: #fcf3d3; }

.grey-dark-text { color: #2c3e50; }
.grey-medium-text { color: #5d6d7e; }
.grey-light-text { color: #85929e; }
</style>
</div>
