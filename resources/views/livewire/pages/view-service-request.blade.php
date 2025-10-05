<div>
    <div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl shadow-custom border border-gray-100">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-4">
                <i class="fas fa-file-alt text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold grey-dark-text mb-2">تفاصيل الطلب رقم: {{ $serviceRequest->id }}</h1>
            <p class="text-lg grey-medium-text">{{ $serviceRequest->serviceType->service_name_ar }}</p>
        </div>

        <!-- Service Request Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-600 ml-2"></i>
                    <span class="font-semibold text-blue-800">معلومات الطلب:</span>
                </div>
                <div class="text-sm text-blue-700 space-x-4">
                    <span>الحالة: {{ $serviceRequest->status }}</span>
                    <span>تاريخ الإنشاء: {{ $serviceRequest->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        </div>

        <!-- Download PDF Button -->
        @if ($serviceRequest->status === 'completed')
            <div class="mb-6 text-center">
                <button wire:click="downloadPdf" class="px-8 py-4 text-lg font-bold rounded-xl text-white gold-bg hover:bg-gold-secondary focus:outline-none focus:ring-2 focus:ring-gold-primary transition-all duration-200 shadow-lg">
                    <i class="fas fa-download ml-2"></i>
                    تحميل كملف PDF
                </button>
            </div>
        @endif

        <!-- Basic Information Section -->
        <div class="bg-gold-light bg-opacity-30 rounded-xl p-6 border border-gold-primary border-opacity-20 mb-6">
            <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                <i class="fas fa-info-circle gold-text ml-2"></i>
                المعلومات الأساسية
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold grey-dark-text">عنوان الطلب:</label>
                    <p class="text-lg grey-medium-text">{{ $serviceRequest->request_title }}</p>
                </div>
                <div>
                    <label class="block text-sm font-bold grey-dark-text">تفاصيل الطلب:</label>
                    <p class="text-lg grey-medium-text">{{ $serviceRequest->request_description }}</p>
                </div>
                @if ($serviceRequest->related_case_id)
                    <div>
                        <label class="block text-sm font-bold grey-dark-text">رقم القضية:</label>
                        <p class="text-lg grey-medium-text">{{ $serviceRequest->related_case_id }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Documents Section -->
        @if ($serviceRequest->documents->count() > 0)
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <h3 class="text-xl font-bold grey-dark-text mb-6 flex items-center">
                    <i class="fas fa-folder-open gold-text ml-2"></i>
                    المستندات المرفقة
                </h3>
                <div class="space-y-4">
                    @foreach ($serviceRequest->documents as $document)
                        <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl p-3">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-gray-600 ml-2"></i>
                                <span class="text-sm text-gray-800 font-medium">{{ $document->document_name }}</span>
                            </div>
                            <a href="{{ Storage::url($document->document_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700 transition-colors">
                                <i class="fas fa-eye"></i> عرض
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
