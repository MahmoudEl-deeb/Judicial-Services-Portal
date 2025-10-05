<div>
    <div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl shadow-custom border border-gray-100">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-4">
                <i class="fas fa-credit-card text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold grey-dark-text mb-2">إتمام عملية الدفع</h1>
            <p class="text-lg grey-medium-text">مراجعة تفاصيل الطلب وتأكيد الدفع</p>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 ml-2"></i>
                    <div class="text-green-700 font-medium">{{ session('message') }}</div>
                </div>
            </div>
        @endif

        <!-- Loading Overlay -->
        <div wire:loading.flex class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gold-primary mx-auto mb-4"></div>
                <p class="text-lg grey-dark-text">جاري معالجة الدفع...</p>
            </div>
        </div>

        <div class="bg-gold-light bg-opacity-30 rounded-xl p-6 border border-gold-primary border-opacity-20">
            <h3 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                <i class="fas fa-file-invoice gold-text ml-2"></i>
                ملخص الطلب
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Order Summary -->
                <div class="space-y-3">
                    <h4 class="font-semibold grey-dark-text">تفاصيل الخدمة:</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="grey-medium-text">رقم الطلب:</span>
                            <span class="font-medium grey-dark-text">{{ $serviceRequest->request_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="grey-medium-text">نوع الخدمة:</span>
                            <span class="font-medium grey-dark-text">{{ $serviceRequest->serviceType->service_name_ar }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="grey-medium-text">نوع المعالجة:</span>
                            <span class="font-medium {{ $serviceRequest->is_urgent_service ? 'text-yellow-600' : 'grey-dark-text' }}">
                                {{ $serviceRequest->is_urgent_service ? 'خدمة عاجلة' : 'خدمة عادية' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Cost Summary -->
                <div class="space-y-3">
                    <h4 class="font-semibold grey-dark-text">تفاصيل التكلفة:</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="grey-medium-text">الرسوم الأساسية:</span>
                            <span class="font-medium text-green-600">{{ number_format($serviceRequest->base_fees_amount, 2) }} ج.م</span>
                        </div>
                        @if($serviceRequest->is_urgent_service)
                            <div class="flex justify-between">
                                <span class="grey-medium-text">رسوم عاجلة:</span>
                                <span class="font-medium text-yellow-600">+ {{ number_format($serviceRequest->urgent_fees_amount, 2) }} ج.م</span>
                            </div>
                        @endif
                        <div class="flex justify-between border-t border-gray-200 pt-2">
                            <span class="font-semibold grey-dark-text">المبلغ الإجمالي:</span>
                            <span class="font-bold text-blue-800 text-lg">{{ number_format($serviceRequest->total_fees_amount, 2) }} ج.م</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-gray-200">
                <button type="button"
                        wire:click="processPayment"
                        wire:loading.attr="disabled"
                        class="w-full flex justify-center items-center px-8 py-4 text-lg font-bold rounded-xl text-white gold-bg hover:bg-gold-secondary focus:outline-none focus:ring-2 focus:ring-gold-primary transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg">
                    
                    <span wire:loading.remove wire:target="processPayment" class="flex items-center">
                        <i class="fas fa-shield-alt ml-2"></i>
                        تأكيد الدفع الآن
                    </span>
                    
                    <span wire:loading wire:target="processPayment" class="flex items-center">
                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white ml-2"></div>
                        جاري المعالجة...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
