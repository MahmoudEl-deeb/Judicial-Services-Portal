<div 
    x-data="servicesPage()" 
    class="min-h-screen bg-gray-50 py-8"
    wire:loading.class="opacity-50"
>
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">خدمات محكمة النقض</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                اكتشف الخدمات الإلكترونية المتاحة واختر الخدمة التي تحتاجها
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="flex-1 w-full md:w-auto">
                    <div class="relative">
                        <input 
                            wire:model.live.debounce.500ms="searchTerm"
                            type="text" 
                            placeholder="ابحث عن خدمة..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Loading indicator for search -->
                        <div 
                            wire:loading.flex 
                            wire:target="searchTerm"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2"
                        >
                            <div class="w-4 h-4 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </div>
                </div>

                <!-- Sort Options -->
                <div class="flex gap-3">
                    <select 
                        wire:model.live="sortBy"
                        class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="name">ترتيب حسب الاسم</option>
                        <option value="newest">الأحدث أولاً</option>
                        <option value="oldest">الأقدم أولاً</option>
                    </select>

                    <!-- Active Services Toggle -->
                    <button 
                        wire:click="toggleActiveOnly"
                        class="px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2 {{ $activeOnly ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                    >
                        <span>الخدمات النشطة فقط</span>
                        @if($activeOnly)
                            <span>✓</span>
                        @endif
                    </button>
                </div>
            </div>

            <!-- Results Counter -->
            @if($services->count() > 0)
                <div class="mt-4 text-sm text-gray-600">
                    عرض {{ $services->count() }} من أصل {{ $totalServices }} خدمة
                </div>
            @endif

            <!-- Clear Filters Button -->
            @if($searchTerm || $activeOnly || $sortBy !== 'name')
                <div class="mt-4">
                    <button 
                        wire:click="clearFilters"
                        class="text-blue-600 hover:text-blue-800 text-sm underline"
                    >
                        مسح جميع الفلاتر
                    </button>
                </div>
            @endif
        </div>

        <!-- Loading State -->
        <div wire:loading.flex wire:target="searchTerm,sortBy,activeOnly" class="justify-center py-12">
            <div class="inline-flex items-center gap-3">
                <div class="w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                <span class="text-gray-600">جاري تحميل الخدمات...</span>
            </div>
        </div>

        <!-- Services Grid -->
        <div wire:loading.remove wire:target="searchTerm,sortBy,activeOnly">
            @if($services->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                    @foreach($services as $service)
                        <div 
                            class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group cursor-pointer"
                            x-data="{ hovered: false }"
                            @mouseenter="hovered = true"
                            @mouseleave="hovered = false"
                            @click="viewService({{ json_encode($service) }})"
                        >
                            <!-- Service Icon/Image Area -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-center relative">
                                <!-- Hover Effect -->
                                <div 
                                    x-show="hovered"
                                    x-transition:enter="transition-opacity duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition-opacity duration-300"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="absolute inset-0 bg-blue-600 opacity-10"
                                ></div>
                                
                                <div class="w-16 h-16 bg-blue-600 rounded-2xl mx-auto flex items-center justify-center group-hover:scale-110 transition-transform duration-300 relative z-10">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $service->service_name_ar }}</h2>
                                <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">{{ $service->description_ar }}</p>
                                
                                <div class="flex justify-between items-center">
                                    <a 
                                        href="#"
                                        class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2"
                                        onclick="event.stopPropagation()"
                                    >
                                        <span>اطلب الآن</span>
                                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                    </a>
                                    
                                    <span class="text-xs px-3 py-1 rounded-full {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $service->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Results State -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">لا توجد خدمات مطابقة للبحث</h3>
                    <p class="text-gray-500 mb-4">حاول تغيير كلمات البحث أو إزالة الفلتر</p>
                    <button 
                        wire:click="clearFilters"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors duration-200"
                    >
                        مسح الفلتر
                    </button>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($services->hasPages())
            <div class="flex justify-center">
                <div class="bg-white rounded-2xl shadow-sm p-4">
                    {{ $services->links() }}
                </div>
            </div>
        @endif

        <!-- Service Modal -->
        <div 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
            @click.self="showModal = false"
            style="display: none;"
        >
            <div 
                x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
            >
                <div class="p-6" x-html="modalContent"></div>
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
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-2xl mx-auto flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">${service.service_name_ar}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">${service.description_ar}</p>
                    <div class="flex gap-4 justify-center">
                        <a href="/service-request/${service.service_type_key}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            طلب الخدمة
                        </a>
                        <button @click="showModal = false" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200">
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

@push('styles')
<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    
    /* Custom Pagination Styles */
    .pagination { display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 8px; }
    .pagination li { margin: 0; }
    .pagination .page-link { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 10px; font-weight: 500; text-decoration: none; transition: all 0.2s; }
    .pagination .page-item.active .page-link { background-color: #2563eb; color: white; border-color: #2563eb; }
    .pagination .page-item:not(.active) .page-link { background-color: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }
    .pagination .page-item:not(.active) .page-link:hover { background-color: #e2e8f0; color: #475569; }
    .pagination .page-item.disabled .page-link { background-color: #f1f5f9; color: #94a3b8; cursor: not-allowed; }
</style>
@endpush