<div>
<div class="min-h-screen bg-[#F8FAFC] py-8" x-data="{
    showImageModal: false,
    selectedImagePath: '',
    selectedImageName: '',
    viewImage(path, name) {
        this.selectedImagePath = path;
        this.selectedImageName = name;
        this.showImageModal = true;
    },
    downloadImage(path, name) {
        window.open(`/download-document?path=${encodeURIComponent(path)}&name=${encodeURIComponent(name)}`, '_blank');
    }
}">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold grey-dark-text mb-2">تفاصيل طلب الخدمة</h1>
                <div class="flex items-center gap-4 text-sm grey-medium-text">
                    <span>رقم الطلب: <strong class="gold-text">{{ $serviceRequest->request_number }}</strong></span>
                    <span>التاريخ: {{ $serviceRequest->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
            <a href="{{ route('admin.service-requests') }}" 
               class="flex items-center gap-2 gold-text hover:text-gold-secondary font-medium transition-colors">
                <i class="fas fa-arrow-right"></i>
                العودة للقائمة
            </a>
        </div>

        <!-- Alert Messages -->
        @if (session()->has('message'))
            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 ml-2"></i>
                    <span class="text-green-700 font-medium">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-400 ml-2"></i>
                    <span class="text-red-700 font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Request Information -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-6 flex items-center">
                        <i class="fas fa-info-circle gold-text ml-2"></i>
                        معلومات الطلب
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">عنوان الطلب</label>
                                <p class="text-gray-700">{{ $serviceRequest->request_title }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">وصف الطلب</label>
                                <p class="text-gray-700 leading-relaxed">{{ $serviceRequest->request_description }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">نوع الخدمة</label>
                                <p class="text-gray-700">{{ $serviceRequest->serviceType->service_name_ar }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">الدائرة</label>
                                <p class="text-gray-700">{{ $serviceRequest->department?->department_name_ar ?: 'غير محدد' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">رقم القضية</label>
                                <p class="text-gray-700">{{ $serviceRequest->related_case_id ?: 'غير محدد' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">الأولوية</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $serviceRequest->priority == 'urgent' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $serviceRequest->priority == 'urgent' ? 'عاجلة' : 'عادية' }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">خدمة عاجلة</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $serviceRequest->is_urgent_service ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $serviceRequest->is_urgent_service ? 'نعم' : 'لا' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requester Information -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-6 flex items-center">
                        <i class="fas fa-user gold-text ml-2"></i>
                        معلومات مقدم الطلب
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">الاسم</label>
                                <p class="text-gray-700">{{ $serviceRequest->requester->first_name }} {{ $serviceRequest->requester->last_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">البريد الإلكتروني</label>
                                <p class="text-gray-700">{{ $serviceRequest->requester->email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">الرقم القومي</label>
                                <p class="text-gray-700">{{ $serviceRequest->client_national_id ?: $serviceRequest->requester->national_id }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold grey-dark-text mb-1">رقم الهاتف</label>
                                <p class="text-gray-700">{{ $serviceRequest->requester->phone ?: 'غير متوفر' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-6 flex items-center">
                        <i class="fas fa-folder-open gold-text ml-2"></i>
                        المستندات المرفوعة
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Required Documents -->
                        @if($serviceRequest->documents->count() > 0)
                        <div>
                            <h3 class="text-lg font-semibold grey-dark-text mb-4 flex items-center">
                                <i class="fas fa-paperclip gold-text ml-2"></i>
                                المستندات المطلوبة للخدمة
                            </h3>
                            <div class="space-y-4">
                                @foreach($serviceRequest->documents as $document)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200">
                                        <div class="flex items-center gap-3">
                                            @if(in_array($document->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']))
                                                <i class="fas fa-image text-green-500 text-xl"></i>
                                            @else
                                                <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $document->document_name }}</p>
                                                <p class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($document->created_at)->format('Y-m-d H:i') }}
                                                    • {{ $this->formatFileSize($document->file_size) }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center gap-2">
                                            @if(in_array($document->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']))
                                                <!-- Use Alpine.js for image viewing -->
                                                <button @click="viewImage('{{ $document->file_path }}', '{{ $document->document_name }}')"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50"
                                                        title="عرض الصورة">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <!-- Direct download for images -->
                                                <button @click="downloadImage('{{ $document->file_path }}', '{{ $document->document_name }}')"
                                                        class="text-green-600 hover:text-green-800 transition-colors p-2 rounded-lg hover:bg-green-50"
                                                        title="تحميل الصورة">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            @else
                                                <button wire:click="viewDocument({{ $document->id }})"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50"
                                                        title="عرض المستند">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button wire:click="downloadDocument({{ $document->id }})"
                                                        class="text-green-600 hover:text-green-800 transition-colors p-2 rounded-lg hover:bg-green-50"
                                                        title="تحميل المستند">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Power of Attorney (التوكيل) for Lawyers -->
                        @if($serviceRequest->requester->hasRole('lawyer') && $serviceRequest->power_of_attorney_path)
                        <div>
                            <h3 class="text-lg font-semibold grey-dark-text mb-4 flex items-center">
                                <i class="fas fa-file-contract text-purple-600 ml-2"></i>
                                التوكيل
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl border border-purple-200">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $extension = pathinfo($serviceRequest->power_of_attorney_path, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <i class="fas fa-image text-purple-500 text-xl"></i>
                                        @else
                                            <i class="fas fa-file-pdf text-purple-500 text-xl"></i>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-800">التوكيل - {{ $serviceRequest->requester->first_name }} {{ $serviceRequest->requester->last_name }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $serviceRequest->created_at->format('Y-m-d H:i') }}
                                                @if(file_exists(storage_path('app/public/' . $serviceRequest->power_of_attorney_path)))
                                                    • {{ $this->formatFileSize(filesize(storage_path('app/public/' . $serviceRequest->power_of_attorney_path))) }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <button @click="viewImage('{{ $serviceRequest->power_of_attorney_path }}', 'التوكيل - {{ $serviceRequest->requester->first_name }} {{ $serviceRequest->requester->last_name }}')"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50"
                                                    title="عرض التوكيل">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                            <button @click="downloadImage('{{ $serviceRequest->power_of_attorney_path }}', 'التوكيل - {{ $serviceRequest->requester->first_name }} {{ $serviceRequest->requester->last_name }}')"
                                                    class="text-green-600 hover:text-green-800 transition-colors p-2 rounded-lg hover:bg-green-50"
                                                    title="تحميل التوكيل">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        @else
                                            <button wire:click="viewPowerOfAttorney"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50"
                                                    title="عرض التوكيل">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button wire:click="downloadPowerOfAttorney"
                                                    class="text-green-600 hover:text-green-800 transition-colors p-2 rounded-lg hover:bg-green-50"
                                                    title="تحميل التوكيل">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($serviceRequest->documents->count() == 0 && (!$serviceRequest->requester->hasRole('lawyer') || !$serviceRequest->power_of_attorney_path))
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-folder-open text-4xl mb-3 opacity-50"></i>
                                <p>لا توجد مستندات مرفوعة</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                        <i class="fas fa-tasks gold-text ml-2"></i>
                        حالة الطلب
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="text-center p-4 bg-gray-50 rounded-xl">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold {{ $this->getStatusBadgeClass($serviceRequest->status) }}">
                                {{ $this->getStatusText($serviceRequest->status) }}
                            </span>
                        </div>
                        
                        <button wire:click="openStatusModal"
                                class="w-full gold-bg hover:bg-gold-secondary text-white py-3 px-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i>
                            تحديث الحالة
                        </button>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                        <i class="fas fa-bolt gold-text ml-2"></i>
                        إجراءات سريعة
                    </h2>
                    
                    <div class="space-y-3">
                        <button wire:click="updateStatusAction('approved')"
                                class="w-full bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-check"></i>
                            قبول الطلب
                        </button>
                        
                        <button wire:click="updateStatusAction('rejected')"
                                class="w-full bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-3 px-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            رفض الطلب
                        </button>
                        
                        <button wire:click="updateStatusAction('completed')"
                                class="w-full bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-flag-checkered"></i>
                            إكمال الطلب
                        </button>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                        <i class="fas fa-credit-card gold-text ml-2"></i>
                        المعلومات المالية
                    </h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">الرسوم الأساسية:</span>
                            <span class="font-bold text-green-600">{{ number_format($serviceRequest->serviceType->base_fee, 2) }} ج.م</span>
                        </div>
                        
                        @if($serviceRequest->is_urgent_service && $serviceRequest->serviceType->urgent_fee_multiplier > 1)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">رسوم عاجلة:</span>
                                <span class="font-bold text-yellow-600">{{ number_format($serviceRequest->serviceType->base_fee * ($serviceRequest->serviceType->urgent_fee_multiplier - 1), 2) }} ج.م</span>
                            </div>
                        @endif
                        
                        <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                            <span class="text-lg font-bold text-gray-800">المبلغ الإجمالي:</span>
                            <span class="text-lg font-bold text-blue-800">{{ number_format($serviceRequest->total_fees_amount, 2) }} ج.م</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">حالة الدفع:</span>
                            <span class="font-bold {{ $serviceRequest->payment_status == 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $serviceRequest->payment_status == 'paid' ? 'مدفوع' : 'غير مدفوع' }}
                            </span>
                        </div>

                        @if($serviceRequest->payment_method)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">طريقة الدفع:</span>
                                <span class="font-bold text-gray-700">
                                    {{ $serviceRequest->payment_method == 'online' ? 'دفع إلكتروني' : 'تحويل بنكي' }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                        <i class="fas fa-info-circle gold-text ml-2"></i>
                        معلومات إضافية
                    </h2>
                    
                    <div class="space-y-3">
                        @if($serviceRequest->assigned_secretary_id)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">السكرتير المعين:</span>
                                <span class="font-bold text-gray-700">{{ $serviceRequest->assignedSecretary?->name ?: 'غير محدد' }}</span>
                            </div>
                        @endif

                        @if($serviceRequest->approved_by_secretary_id)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">تمت الموافقة بواسطة:</span>
                                <span class="font-bold text-gray-700">{{ $serviceRequest->approvedBySecretary?->name ?: 'غير محدد' }}</span>
                            </div>
                        @endif

                        @if($serviceRequest->submitted_at)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">تاريخ التقديم:</span>
                                <span class="font-bold text-gray-700">{{ $serviceRequest->submitted_at->format('Y-m-d H:i') }}</span>
                            </div>
                        @endif

                        @if($serviceRequest->rest_days)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">الأيام المتبقية:</span>
                                <span class="font-bold {{ $serviceRequest->rest_days < 3 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $serviceRequest->rest_days }} يوم
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6">
                    <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                        <i class="fas fa-history gold-text ml-2"></i>
                        الخط الزمني
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-plus text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">إنشاء الطلب</p>
                                <p class="text-sm text-gray-500">{{ $serviceRequest->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($serviceRequest->submitted_at)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-paper-plane text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">تقديم الطلب</p>
                                    <p class="text-sm text-gray-500">{{ $serviceRequest->submitted_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($serviceRequest->approved_date)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">تم القبول</p>
                                    <p class="text-sm text-gray-500">{{ $serviceRequest->approved_date->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($serviceRequest->completed_date)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-flag-checkered text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">إكتمل الطلب</p>
                                    <p class="text-sm text-gray-500">{{ $serviceRequest->completed_date->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Viewer Modal using Alpine.js -->
    <div x-show="showImageModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center p-4 z-50">
        
        <div class="relative max-w-7xl max-h-full">
            <!-- Close Button -->
            <button @click="showImageModal = false"
                    class="absolute top-4 left-4 text-white hover:text-gray-300 transition-colors z-10 bg-black bg-opacity-50 rounded-full p-2">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <!-- Download Button -->
            <button @click="downloadImage(selectedImagePath, selectedImageName)"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10 bg-black bg-opacity-50 rounded-full p-2">
                <i class="fas fa-download text-xl"></i>
            </button>
            
            <!-- Image - FIXED URL CONSTRUCTION -->
            <template x-if="selectedImagePath">
                <img :src="`/storage/${selectedImagePath}`" 
                     :alt="selectedImageName"
                     class="max-w-full max-h-full object-contain rounded-lg">
            </template>
            
            <!-- Image Name -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-4 py-2 rounded-lg" x-text="selectedImageName">
            </div>
        </div>
    </div>

    <!-- Document Modal -->
    @if($showDocumentModal && $selectedDocument)
        <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-50"
             x-data
             x-show="true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="bg-white rounded-2xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold grey-dark-text">عرض المستند</h3>
                    <div class="flex items-center gap-2">
                        <button wire:click="downloadDocument({{ $selectedDocument->id }})"
                                class="text-green-600 hover:text-green-800 transition-colors p-2 rounded-lg hover:bg-green-50"
                                title="تحميل المستند">
                            <i class="fas fa-download"></i>
                        </button>
                        <button wire:click="closeDocumentModal"
                                class="text-gray-500 hover:text-gray-700 transition-colors p-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="text-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $selectedDocument->document_name }}</h4>
                        <p class="text-sm text-gray-500">تم الرفع في: {{ $selectedDocument->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 h-96">
                        <embed src="{{ asset('storage/' . $selectedDocument->file_path) }}" type="application/pdf" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Status Update Modal -->
    @if($showStatusModal)
        <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-50"
             x-data
             x-show="true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold grey-dark-text">تحديث حالة الطلب</h3>
                    <button wire:click="closeStatusModal"
                            class="text-gray-500 hover:text-gray-700 transition-colors p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form wire:submit.prevent="updateStatus" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-bold grey-dark-text mb-2">الحالة الجديدة</label>
                        <select wire:model="status" 
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="pending_approval">بانتظار الموافقة</option>
                            <option value="approved">مقبول</option>
                            <option value="rejected">مرفوض</option>
                            <option value="completed">مكتمل</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold grey-dark-text mb-2">
                            @if($status == 'rejected')
                                سبب الرفض
                            @else
                                ملاحظات الإدارة
                            @endif
                        </label>
                        <textarea wire:model="adminNotes" 
                                  rows="4"
                                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                                  placeholder="@if($status == 'rejected') سبب الرفض... @else أضف ملاحظات حول حالة الطلب... @endif"></textarea>
                        @error('adminNotes')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                                class="flex-1 gold-bg hover:bg-gold-secondary text-white py-3 px-4 rounded-xl font-bold transition-all duration-300">
                            حفظ التغييرات
                        </button>
                        <button type="button"
                                wire:click="closeStatusModal"
                                class="flex-1 border border-gray-300 text-gray-700 hover:bg-gray-50 py-3 px-4 rounded-xl font-bold transition-all duration-300">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
</div>
