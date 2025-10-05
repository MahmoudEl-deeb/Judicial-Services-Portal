<div>
<div 
    x-data="servicesPage()" 
    class="min-h-screen bg-[#F8FAFC] py-8"
    wire:loading.class="opacity-50"
>
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-6">
                <i class="fas fa-gavel text-2xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold grey-dark-text mb-4">خدمات محكمة النقض الإلكترونية</h1>
            <p class="text-xl grey-medium-text max-w-2xl mx-auto leading-relaxed">
                اكتشف مجموعة الخدمات القضائية المتاحة واختر الخدمة التي تحتاجها لتقديم طلبك إلكترونياً
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6 mb-8">
            <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                <!-- Search Input -->
                <div class="flex-1 w-full lg:w-auto">
                    <div class="relative">
                        <input 
                            wire:model.live.debounce.500ms="searchTerm"
                            type="text" 
                            placeholder="ابحث عن خدمة..."
                            class="w-full pr-12 pl-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                        >
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        
                        <!-- Loading indicator for search -->
                        <div 
                            wire:loading.flex 
                            wire:target="searchTerm"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2"
                        >
                            <div class="w-4 h-4 border-2 border-gold-primary border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </div>
                </div>

                <!-- Sort Options -->
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <div class="relative flex-1">
                        <select 
                            wire:model.live="sortBy"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary appearance-none transition-all duration-300"
                        >
                            <option value="name">ترتيب حسب الاسم</option>
                            <option value="newest">الأحدث أولاً</option>
                            <option value="oldest">الأقدم أولاً</option>
                        </select>
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="fas fa-sort text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Active Services Toggle -->
                    <button 
                        wire:click="toggleActiveOnly"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300 flex items-center gap-3 border-2 {{ $activeOnly ? 'gold-bg text-white border-gold-primary' : 'bg-white text-gray-700 border-gray-300 hover:border-gold-primary' }}"
                    >
                        <span>الخدمات النشطة فقط</span>
                        @if($activeOnly)
                            <i class="fas fa-check text-sm"></i>
                        @endif
                    </button>
                </div>
            </div>

            <!-- Results Counter and Clear Filters -->
            <div class="flex flex-col sm:flex-row justify-between items-center mt-4 pt-4 border-t border-gray-200">
                @if($services->count() > 0)
                    <div class="text-sm grey-medium-text">
                        عرض <span class="font-bold gold-text">{{ $services->count() }}</span> من أصل <span class="font-bold grey-dark-text">{{ $totalServices }}</span> خدمة
                    </div>
                @endif

                <!-- Clear Filters Button -->
                @if($searchTerm || $activeOnly || $sortBy !== 'name')
                    <div>
                        <button 
                            wire:click="clearFilters"
                            class="text-gold-primary hover:text-gold-secondary text-sm font-medium flex items-center gap-2 transition-colors duration-300"
                        >
                            <i class="fas fa-times"></i>
                            مسح جميع الفلاتر
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Loading State -->
        <div wire:loading.flex wire:target="searchTerm,sortBy,activeOnly" class="justify-center py-16">
            <div class="inline-flex items-center gap-4 bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                <div class="w-6 h-6 border-2 border-gold-primary border-t-transparent rounded-full animate-spin"></div>
                <span class="grey-medium-text">جاري تحميل الخدمات...</span>
            </div>
        </div>

        <!-- Services Grid -->
        <div wire:loading.remove wire:target="searchTerm,sortBy,activeOnly">
            @if($services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
                    @foreach($services as $service)
                        <div 
                            class="bg-white rounded-2xl shadow-custom border border-gray-100 hover:shadow-xl hover:border-gold-primary transition-all duration-500 overflow-hidden group cursor-pointer"
                            x-data="{ hovered: false }"
                            @mouseenter="hovered = true"
                            @mouseleave="hovered = false"
                            @click="viewService({{ json_encode($service) }})"
                        >
                            <!-- Service Header -->
                            <div class="bg-gradient-to-br from-[#2D3748] to-[#4A5568] p-6 text-white relative overflow-hidden">
                                <!-- Hover Effect -->
                                <div 
                                    x-show="hovered"
                                    x-transition:enter="transition-opacity duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition-opacity duration-300"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="absolute inset-0 bg-gold-primary opacity-20"
                                ></div>
                                
                                <!-- Service Icon -->
                                <div class="w-16 h-16 gold-bg rounded-2xl mx-auto flex items-center justify-center group-hover:scale-110 transition-transform duration-300 relative z-10 shadow-lg">
                                    <i class="fas fa-balance-scale text-white text-2xl"></i>
                                </div>

                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4 z-10">
                                    <span class="text-xs px-3 py-1 rounded-full {{ $service->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} font-medium">
                                        {{ $service->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6">
                                <h2 class="text-xl font-bold grey-dark-text mb-3 line-clamp-2 group-hover:gold-text transition-colors duration-300">
                                    {{ $service->service_name_ar }}
                                </h2>
                                <p class="grey-medium-text text-sm leading-relaxed mb-6 line-clamp-3">
                                    {{ $service->description_ar }}
                                </p>
                                
                                <!-- Service Details -->
                                <div class="flex items-center justify-between text-xs grey-light-text mb-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $service->processing_time_hours ?? 72 }} ساعة</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-coins"></i>
                                        <span>{{ number_format($service->base_fees_amount ?? 0, 2) }} ج.م</span>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex justify-between items-center">
                                    <a 
                                        href="{{ route('services.create',base64_encode($service->id )) }}"
                                        class="gold-bg hover:bg-gold-secondary text-white py-3 px-6 rounded-xl font-bold transition-all duration-300 flex items-center gap-3 shadow-lg hover:shadow-xl"
                                        onclick="event.stopPropagation()"
                                    >
                                        <span>اطلب الخدمة</span>
                                        <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                                    </a>
                                    
                                    <button class="text-gold-primary hover:text-gold-secondary transition-colors duration-300 flex items-center gap-2">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="text-sm">تفاصيل</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Results State -->
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold grey-dark-text mb-3">لا توجد خدمات مطابقة للبحث</h3>
                    <p class="text-lg grey-medium-text mb-6 max-w-md mx-auto">
                        لم نتمكن من العثور على خدمات تطابق معايير البحث المطلوبة
                    </p>
                    <button 
                        wire:click="clearFilters"
                        class="gold-bg hover:bg-gold-secondary text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg flex items-center gap-3 mx-auto"
                    >
                        <i class="fas fa-times"></i>
                        مسح جميع الفلاتر
                    </button>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($services->hasPages())
            <div class="flex justify-center">
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-4">
                    <!-- Enhanced Pagination -->
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <!-- Custom Pagination Links -->
                        <nav class="flex items-center space-x-2 space-x-reverse">
                            <!-- First Page -->
                            @if($services->onFirstPage())
                                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-angle-double-right"></i>
                                </span>
                            @else
                                <a href="{{ $services->url(1) }}" 
                                   class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            @endif

                            <!-- Previous Page -->
                            @if($services->onFirstPage())
                                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            @else
                                <a href="{{ $services->previousPageUrl() }}" 
                                   class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach($services->getUrlRange(max(1, $services->currentPage() - 2), min($services->lastPage(), $services->currentPage() + 2)) as $page => $url)
                                @if($page == $services->currentPage())
                                    <span class="px-4 py-2 gold-bg text-white rounded-lg font-bold shadow-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                       class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            <!-- Next Page -->
                            @if($services->hasMorePages())
                                <a href="{{ $services->nextPageUrl() }}" 
                                   class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            @else
                                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-angle-left"></i>
                                </span>
                            @endif

                            <!-- Last Page -->
                            @if($services->hasMorePages())
                                <a href="{{ $services->url($services->lastPage()) }}" 
                                   class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            @else
                                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-angle-double-left"></i>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        @endif

        <!-- Help Section -->
        <div class="mt-16 bg-white rounded-2xl shadow-custom border border-gray-100 p-8 text-center">
            <div class="max-w-2xl mx-auto">
                <div class="w-16 h-16 gold-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-white text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold grey-dark-text mb-4">هل تحتاج مساعدة؟</h3>
                <p class="text-lg grey-medium-text mb-6">
                    فريق الدعم الفني جاهز لمساعدتك في اختيار الخدمة المناسبة وتقديم الطلبات
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:16000" class="bg-gold-primary hover:bg-gold-secondary text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 flex items-center gap-3 justify-center">
                        <i class="fas fa-phone"></i>
                        16000
                    </a>
                    <a href="mailto:support@cassation.gov.eg" class="border-2 border-gold-primary text-gold-primary hover:bg-gold-light px-8 py-3 rounded-xl font-bold transition-all duration-300 flex items-center gap-3 justify-center">
                        <i class="fas fa-envelope"></i>
                        support@cassation.gov.eg
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('servicesPage', () => ({
        // State
        showModal: false,
        modalContent: '',
        
        init() {
            // Any initialization logic
        },
        
        // View service details in modal
        viewService(service) {
            this.modalContent = `
                <div class="text-center p-6">
                    <div class="w-20 h-20 gold-bg rounded-2xl mx-auto flex items-center justify-center mb-6">
                        <i class="fas fa-balance-scale text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold grey-dark-text mb-4">${service.service_name_ar}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed text-right">${service.description_ar}</p>
                    
                    <!-- Service Details -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <i class="fas fa-clock text-gold-primary text-xl mb-2"></i>
                            <div class="text-sm grey-medium-text">مدة المعالجة</div>
                            <div class="font-bold grey-dark-text">${service.processing_time_hours || 72} ساعة</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <i class="fas fa-coins text-gold-primary text-xl mb-2"></i>
                            <div class="text-sm grey-medium-text">الرسوم الأساسية</div>
                            <div class="font-bold grey-dark-text">${(service.base_fees_amount || 0).toLocaleString('ar-EG')} ج.م</div>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 justify-center">
                        <a href="/services/create/${service.id}" class="gold-bg hover:bg-gold-secondary text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 flex items-center gap-3">
                            <i class="fas fa-paper-plane"></i>
                            طلب الخدمة
                        </a>
                        <button @click="showModal = false" class="border-2 border-gray-300 text-gray-700 hover:bg-gray-50 px-8 py-3 rounded-xl font-bold transition-all duration-300 flex items-center gap-3">
                            <i class="fas fa-times"></i>
                            إغلاق
                        </button>
                    </div>
                </div>
            `;
            this.showModal = true;
        }
    }));
});
</script>
@endpush

<style>
    .line-clamp-2 { 
        display: -webkit-box; 
        -webkit-line-clamp: 2; 
        -webkit-box-orient: vertical; 
        overflow: hidden; 
    }
    .line-clamp-3 { 
        display: -webkit-box; 
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical; 
        overflow: hidden; 
    }
    
    /* Custom scrollbar for modal */
    .modal-content::-webkit-scrollbar {
        width: 6px;
    }
    .modal-content::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    .modal-content::-webkit-scrollbar-thumb {
        background: #D4AF37;
        border-radius: 3px;
    }
</style>
</div>