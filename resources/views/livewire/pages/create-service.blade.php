<div>
<div class="max-w-2xl mx-auto p-8 bg-white rounded-lg shadow-lg" 
     x-data="serviceForm()" 
     x-init="init()">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">طلب خدمة: {{ $serviceType->name }}</h1>
        <p class="text-gray-600">{{ $serviceType->description }}</p>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
             :style="`width: ${progress}%`"></div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <i class="fas fa-check-circle text-green-400 ml-2 mt-1"></i>
                <div class="text-sm text-green-700">{{ session('message') }}</div>
            </div>
        </div>
    @endif

    <!-- Loading Overlay -->
    <div wire:loading.flex class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 text-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600">جاري إرسال الطلب...</p>
        </div>
    </div>

    <form wire:submit.prevent="createServiceRequest" @submit.prevent="submitForm" class="space-y-6">

        <!-- Request Title -->
        <div class="space-y-2">
            <label for="request_title" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-heading text-blue-500 ml-2"></i>
                عنوان الطلب <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="text" 
                       id="request_title" 
                       wire:model.live="request_title"
                       x-model="form.title"
                       @input="updateProgress(); validateField('title')"
                       :class="errors.title ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
                       class="block w-full px-3 py-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 transition-colors"
                       placeholder="أدخل عنوان واضح للطلب"
                       maxlength="200">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-edit text-gray-400"></i>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div x-show="errors.title" x-transition class="text-red-500 text-sm">
                    <i class="fas fa-exclamation-circle ml-1"></i>
                    <span x-text="errors.title"></span>
                </div>
                @error('request_title')
                    <div class="text-red-500 text-sm">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="text-xs text-gray-500">
                    <span x-text="form.title.length"></span>/200
                </div>
            </div>
        </div>

        <!-- Request Description -->
        <div class="space-y-2">
            <label for="request_description" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-align-left text-blue-500 ml-2"></i>
                تفاصيل الطلب <span class="text-red-500">*</span>
            </label>
            <textarea id="request_description"
                      wire:model.live="request_description"
                      x-model="form.description"
                      @input="updateProgress(); validateField('description')"
                      :class="errors.description ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'"
                      class="block w-full px-3 py-3 border rounded-lg focus:outline-none focus:ring-2 resize-none transition-colors"
                      rows="6"
                      maxlength="1000"
                      placeholder="اشرح تفاصيل طلبك بوضوح..."></textarea>
            <div class="flex justify-between items-center">
                <div x-show="errors.description" x-transition class="text-red-500 text-sm">
                    <i class="fas fa-exclamation-circle ml-1"></i>
                    <span x-text="errors.description"></span>
                </div>
                @error('request_description')
                    <div class="text-red-500 text-sm">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="text-xs text-gray-500">
                    <span x-text="form.description.length"></span>/1000
                </div>
            </div>
        </div>

        <!-- Document Upload Sections -->
        @if (!empty($serviceType->required_documents))
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2">
                    <i class="fas fa-folder-open text-blue-500 ml-2"></i>
                    المستندات المطلوبة
                </h3>
                
                @foreach ($serviceType->required_documents as $key => $doc)
                    <div class="space-y-2">
                        <label for="document_{{ $key }}" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-paperclip text-blue-500 ml-2"></i>
                            {{ $doc }}
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="border-2 border-dashed rounded-lg p-6 text-center transition-colors duration-300 @if (isset($documents[$key])) border-green-400 bg-green-50 @else @error('documents.' . $key) border-red-400 @else border-gray-300 hover:border-blue-400 @enderror @endif">
                            
                            <div class="space-y-2">
                                <i class="fas fa-cloud-upload-alt text-4xl @if (isset($documents[$key])) text-green-500 @else text-gray-400 @endif"></i>
                                <div>
                                    <label for="document_{{ $key }}" 
                                           class="cursor-pointer font-medium transition-colors @if (isset($documents[$key])) text-green-600 hover:text-green-500 @else text-blue-600 hover:text-blue-500 @endif">
                                        <span>@if (isset($documents[$key])) تغيير الملف @else اختر الملف @endif</span>
                                        <input type="file" 
                                               id="document_{{ $key }}" 
                                               wire:model.live="documents.{{ $key }}" 
                                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                               @change="updateProgress()"
                                               class="hidden">
                                    </label>
                                    @if (!isset($documents[$key]))
                                        <span class="text-gray-600"> أو اسحب الملف هنا</span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, PNG حتى 10MB</p>
                            </div>
                        </div>

                        <!-- Upload Progress -->
                        <div wire:loading wire:target="documents.{{ $key }}" class="text-sm text-blue-600 flex items-center">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 ml-2"></div>
                            جاري رفع الملف...
                        </div>

                        <!-- Uploaded File Display -->
                        @if (isset($documents[$key]))
                            <div class="mt-3 fade-in">
                                <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-check text-green-600 ml-2"></i>
                                        <span class="text-sm text-green-800 font-medium">{{ $documents[$key]->getClientOriginalName() }}</span>
                                        <span class="text-xs text-green-600 mr-2">({{ number_format($documents[$key]->getSize() / 1024, 1) }} KB)</span>
                                    </div>
                                    <button type="button" 
                                            wire:click="$set('documents.{{ $key }}', null)" 
                                            class="text-red-500 hover:text-red-700 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endif

                        @error('documents.' . $key)
                            <div class="text-red-500 text-sm">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit"
                    wire:loading.attr="disabled"
                    :disabled="!isFormValid"
                    :class="(!isFormValid || $wire.loading) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700 transform hover:scale-105'"
                    class="w-full flex justify-center items-center px-6 py-4 text-lg font-medium rounded-lg text-white bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                
                <span wire:loading.remove wire:target="createServiceRequest" class="flex items-center">
                    <i class="fas fa-paper-plane ml-2"></i>
                    إرسال الطلب
                </span>
                
                <span wire:loading wire:target="createServiceRequest" class="flex items-center">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white ml-2"></div>
                    جاري الإرسال...
                </span>
            </button>
        </div>
    </form>

    <!-- Help Section -->
    <div class="mt-8 p-4 bg-gray-50 rounded-lg border">
        <h4 class="text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-question-circle text-blue-500 ml-1"></i>
            تحتاج مساعدة؟
        </h4>
        <div class="space-y-2 text-sm text-gray-600">
            <p>• املأ العنوان والوصف بوضوح</p>
            <p>• أرفق المستندات المطلوبة</p>
            <p>• سيتم إشعارك بحالة الطلب عبر البريد الإلكتروني</p>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-200">
            <p class="text-xs text-gray-500">
                للمساعدة الفنية: <span class="text-blue-600">support@court.gov.eg</span> | 
                الهاتف: <span class="text-blue-600">16000</span>
            </p>
        </div>
    </div>
</div>

<script>
function serviceForm() {
    return {
        // Form data (synced with Livewire)
        form: {
            title: @entangle('request_title'),
            description: @entangle('request_description')
        },
        
        // UI state
        errors: {},
        progress: 0,
        requiredDocuments: @json($serviceType->required_documents ?? []),
        uploadedDocuments: @entangle('documents'),

        init() {
            this.updateProgress();
            this.$watch('form', () => this.updateProgress());
            this.$watch('uploadedDocuments', () => this.updateProgress());
        },

        updateProgress() {
            let totalFields = 2; // title + description
            let filledFields = 0;
            
            // Check basic fields
            if (this.form.title && this.form.title.trim()) filledFields++;
            if (this.form.description && this.form.description.trim()) filledFields++;
            
            // Add required documents to total
            totalFields += this.requiredDocuments.length;
            
            // Count uploaded documents
            Object.keys(this.uploadedDocuments || {}).forEach(key => {
                if (this.uploadedDocuments[key]) filledFields++;
            });
            
            this.progress = Math.round((filledFields / totalFields) * 100);
        },

        get isFormValid() {
            // Check basic fields
            const hasTitle = this.form.title && this.form.title.trim().length >= 10;
            const hasDescription = this.form.description && this.form.description.trim().length >= 20;
            
            // Check required documents
            let hasAllDocuments = true;
            for (let i = 0; i < this.requiredDocuments.length; i++) {
                if (!this.uploadedDocuments || !this.uploadedDocuments[i]) {
                    hasAllDocuments = false;
                    break;
                }
            }
            
            // Check no validation errors
            const noErrors = Object.keys(this.errors).length === 0;
            
            return hasTitle && hasDescription && hasAllDocuments && noErrors;
        },

        validateField(field) {
            // Clear existing error
            delete this.errors[field];
            
            switch(field) {
                case 'title':
                    if (!this.form.title || !this.form.title.trim()) {
                        this.errors.title = 'عنوان الطلب مطلوب';
                    } else if (this.form.title.trim().length < 10) {
                        this.errors.title = 'العنوان قصير جداً (10 أحرف على الأقل)';
                    }
                    break;
                    
                case 'description':
                    if (!this.form.description || !this.form.description.trim()) {
                        this.errors.description = 'وصف الطلب مطلوب';
                    } else if (this.form.description.trim().length < 20) {
                        this.errors.description = 'الوصف قصير جداً (20 حرف على الأقل)';
                    }
                    break;
            }
        },

        submitForm() {
            // Validate all fields before submission
            this.validateField('title');
            this.validateField('description');
            
            // If there are errors, don't submit
            if (Object.keys(this.errors).length > 0) {
                return false;
            }
            
            // Let Livewire handle the actual submission
            return true;
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }

.fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(-10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* File upload animations */
.border-dashed {
    transition: all 0.3s ease;
}

/* Progress bar animation */
.bg-blue-600 {
    transition: width 0.5s ease-in-out;
}

/* Button hover effects */
button:not(:disabled):hover {
    transform: translateY(-1px);
}

/* Custom scrollbar for textarea */
textarea::-webkit-scrollbar {
    width: 6px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>
</div>
