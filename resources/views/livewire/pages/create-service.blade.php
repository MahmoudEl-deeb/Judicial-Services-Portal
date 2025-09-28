{{-- @dd($serviceTypeTypeType) --}}
<div class="max-w-2xl mx-auto p-8 bg-white rounded-lg shadow-lg" 
     x-data="serviceRequestForm()" 
     x-init="init()">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">طلب {{$serviceType->service_name_ar}}</h1>
        <p class="text-gray-600">اختر الخدمة المطلوبة واملأ البيانات</p>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <i class="fas fa-check-circle text-green-400 ml-2 mt-1"></i>
                <div class="text-sm text-green-700">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Loading Overlay -->
    <div x-show="loading" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 text-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600">جاري إرسال الطلب...</p>
        </div>
    </div>

    <form wire:submit.prevent="createServiceRequest" @submit.prevent="handleSubmit" class="space-y-6">



        <!-- Lawyer Selection (Conditional) -->
        <div x-show="showLawyerSelection || $wire.requiresLawyerSignature" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="space-y-2 p-4 bg-purple-50 border border-purple-200 rounded-lg">
            
            <div class="flex items-center mb-2">
                <i class="fas fa-user-tie text-purple-600 ml-2"></i>
                <h3 class="text-lg font-medium text-gray-800">اختيار المحامي</h3>
            </div>
            
            @if($requiresLawyerSignature)
                <div class="space-y-2">
                    <label for="lawyer" class="block text-sm font-medium text-gray-700">
                        المحامي المطلوب <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="lawyer" 
                                wire:model="selectedLawyer"
                                x-model="form.selectedLawyer"
                                :class="errors.selectedLawyer ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-purple-500 focus:ring-purple-500'"
                                class="block w-full px-3 py-3 pl-10 border rounded-lg shadow-sm focus:outline-none transition-colors duration-200 bg-white">
                            <option value="">-- اختر المحامي --</option>
                            @foreach($lawyers as $lawyer)
                                <option value="{{ $lawyer->id }}">{{ $lawyer->first_name }} {{ $lawyer->last_name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tie text-gray-400"></i>
                        </div>
                    </div>
                    <div x-show="errors.selectedLawyer" x-transition class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        <span x-text="errors.selectedLawyer"></span>
                    </div>
                    @error('selectedLawyer') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            @endif
        </div>

        <!-- Request Title -->
        <div class="space-y-2">
            <label for="title" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-heading text-blue-500 ml-2"></i>
                عنوان الطلب <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="text" 
                       id="title" 
                       wire:model.live="request_title"
                       x-model="form.request_title"
                       @blur="validateField('request_title')"
                       :class="errors.request_title ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'"
                       class="block w-full px-3 py-3 pl-10 border rounded-lg shadow-sm focus:outline-none transition-colors duration-200"
                       placeholder="أدخل عنوان واضح للطلب"
                       maxlength="200">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-edit text-gray-400"></i>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div x-show="errors.request_title" x-transition class="text-red-500 text-sm flex items-center">
                    <i class="fas fa-exclamation-circle ml-1"></i>
                    <span x-text="errors.request_title"></span>
                </div>
                <div class="text-xs text-gray-500">
                    <span x-text="form.request_title?.length || 0"></span>/200
                </div>
            </div>
            @error('request_title') 
                <span class="text-red-500 text-sm flex items-center">
                    <i class="fas fa-exclamation-circle ml-1"></i>
                    {{ $message }}
                </span> 
            @enderror
        </div>

        <!-- Request Description -->
        <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-align-left text-blue-500 ml-2"></i>
                تفاصيل الطلب <span class="text-red-500">*</span>
            </label>
            <textarea id="description" 
                      wire:model.live="request_description"
                      x-model="form.request_description"
                      @blur="validateField('request_description')"
                      :class="errors.request_description ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'"
                      class="block w-full px-3 py-3 border rounded-lg shadow-sm focus:outline-none transition-colors duration-200 resize-none"
                      rows="6"
                      maxlength="1000"
                      placeholder="اشرح تفاصيل طلبك بوضوح..."></textarea>
            <div class="flex justify-between items-center">
                <div x-show="errors.request_description" x-transition class="text-red-500 text-sm flex items-center">
                    <i class="fas fa-exclamation-circle ml-1"></i>
                    <span x-text="errors.request_description"></span>
                </div>
                <div class="text-xs text-gray-500">
                    <span x-text="form.request_description?.length || 0"></span>/1000
                </div>
            </div>
            @error('request_description') 
                <span class="text-red-500 text-sm flex items-center">
                    <i class="fas fa-exclamation-circle ml-1"></i>
                    {{ $message }}
                </span> 
            @enderror
        </div>

        @foreach ($serviceType->required_documents as $key )
        
        <!-- File Attachments (Optional) -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                <i class="fas fa-paperclip text-blue-500 ml-2"></i>
                {{-- المرفقات (اختياري) --}}
                {{$key}}
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-300">
                <div class="space-y-2">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                    <div>
                        <button type="button" 
                                @click="document.getElementById('file-upload').click()"
                                class="text-blue-600 hover:text-blue-500 font-medium">
                            اختر الملفات
                        </button>
                        <span class="text-gray-600"> أو اسحب الملفات هنا</span>
                    </div>
                    <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, PNG حتى 10MB لكل ملف</p>
                </div>
                <input type="file" 
                       id="file-upload" 
                       multiple 
                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                       class="hidden"
                       @change="handleFileUpload($event)">
            </div>
            <div x-show="uploadedFiles.length > 0" class="mt-3">
                <h4 class="text-sm font-medium text-gray-700 mb-2">الملفات المرفقة:</h4>
                <template x-for="(file, index) in uploadedFiles" :key="index">
                    <div class="flex items-center justify-between bg-gray-50 rounded p-2 mb-1">
                        <div class="flex items-center">
                            <i class="fas fa-file text-blue-500 ml-2"></i>
                            <span class="text-sm text-gray-700" x-text="file.name"></span>
                        </div>
                        <button type="button" 
                                @click="removeFile(index)"
                                class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </template>
            </div>
        </div>
        @endforeach

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit" 
                    :disabled="loading || !isFormValid"
                    :class="loading || !isFormValid ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700 transform hover:scale-105'"
                    class="w-full flex justify-center items-center px-6 py-4 border border-transparent text-lg font-medium rounded-lg text-white bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <span x-show="!loading" class="flex items-center">
                    <i class="fas fa-paper-plane ml-2"></i>
                    إرسال الطلب
                </span>
                <span x-show="loading" class="flex items-center">
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
            <p>• اختر الخدمة المناسبة من القائمة</p>
            <p>• املأ العنوان والوصف بوضوح</p>
            <p>• أرفق المستندات المطلوبة إن وجدت</p>
            <p>• سيتم إشعارك بحالة الطلب عبر البريد الإلكتروني</p>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-200">
            <p class="text-xs text-gray-500">
                للمساعدة الفنية: <span class="text-blue-600">support@court.gov.eg</span> | 
                الهاتف: <span class="text-blue-600">16000</span>
            </p>
        </div>
    </div>

    <script>
        function serviceRequestForm() {
            return {
                // Form data
                form: {
                    selectedService: @entangle('selectedService'),
                    selectedLawyer: @entangle('selectedLawyer'),
                    request_title: @entangle('request_title'),
                    request_description: @entangle('request_description')
                },
                
                // UI state
                loading: false,
                errors: {},
                progress: 0,
                showLawyerSelection: false,
                uploadedFiles: [],

                init() {
                    this.updateProgress();
                    this.$watch('form', () => {
                        this.updateProgress();
                    });
                },

                updateProgress() {
                    let totalFields = 3; // service, title, description
                    let filledFields = 0;
                    
                    if (this.form.selectedService) filledFields++;
                    if (this.form.request_title && this.form.request_title.trim()) filledFields++;
                    if (this.form.request_description && this.form.request_description.trim()) filledFields++;
                    
                    // Add lawyer field if required
                    if (this.showLawyerSelection || @json($requiresLawyerSignature ?? false)) {
                        totalFields++;
                        if (this.form.selectedLawyer) filledFields++;
                    }
                    
                    this.progress = Math.round((filledFields / totalFields) * 100);
                },

                handleServiceChange() {
                    this.validateField('selectedService');
                    // The wire:change will handle the backend logic
                },

                get isFormValid() {
                    const hasBasicFields = this.form.selectedService && 
                                         this.form.request_title && 
                                         this.form.request_description;
                    
                    const hasLawyerIfRequired = !(@json($requiresLawyerSignature ?? false)) || 
                                              this.form.selectedLawyer;
                    
                    return hasBasicFields && hasLawyerIfRequired && Object.keys(this.errors).length === 0;
                },

                validateField(field) {
                    this.errors = { ...this.errors };
                    delete this.errors[field];
                    
                    switch(field) {
                        case 'selectedService':
                            if (!this.form.selectedService) {
                                this.errors.selectedService = 'يرجى اختيار الخدمة';
                            }
                            break;
                            
                        case 'selectedLawyer':
                            if ((@json($requiresLawyerSignature ?? false)) && !this.form.selectedLawyer) {
                                this.errors.selectedLawyer = 'يرجى اختيار المحامي';
                            }
                            break;
                            
                        case 'request_title':
                            if (!this.form.request_title || !this.form.request_title.trim()) {
                                this.errors.request_title = 'عنوان الطلب مطلوب';
                            } else if (this.form.request_title.trim().length < 10) {
                                this.errors.request_title = 'العنوان قصير جداً (10 أحرف على الأقل)';
                            }
                            break;
                            
                        case 'request_description':
                            if (!this.form.request_description || !this.form.request_description.trim()) {
                                this.errors.request_description = 'وصف الطلب مطلوب';
                            } else if (this.form.request_description.trim().length < 20) {
                                this.errors.request_description = 'الوصف قصير جداً (20 حرف على الأقل)';
                            }
                            break;
                    }
                },

                handleFileUpload(event) {
                    const files = Array.from(event.target.files);
                    const maxSize = 10 * 1024 * 1024; // 10MB
                    const allowedTypes = [
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'image/jpeg',
                        'image/jpg',
                        'image/png'
                    ];
                    
                    files.forEach(file => {
                        if (!allowedTypes.includes(file.type)) {
                            alert(`نوع الملف ${file.name} غير مدعوم`);
                            return;
                        }
                        
                        if (file.size > maxSize) {
                            alert(`الملف ${file.name} كبير جداً (أكثر من 10MB)`);
                            return;
                        }
                        
                        this.uploadedFiles.push(file);
                    });
                    
                    // Clear the input
                    event.target.value = '';
                },

                removeFile(index) {
                    this.uploadedFiles.splice(index, 1);
                },

                handleSubmit() {
                    this.loading = true;
                    this.errors = {};
                    
                    // Validate all fields
                    this.validateField('selectedService');
                    this.validateField('request_title');
                    this.validateField('request_description');
                    
                    if (@json($requiresLawyerSignature ?? false)) {
                        this.validateField('selectedLawyer');
                    }
                    
                    if (Object.keys(this.errors).length > 0) {
                        this.loading = false;
                        return;
                    }
                    
                    // Form will be submitted by Livewire
                    setTimeout(() => {
                        this.loading = false;
                    }, 3000);
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Textarea auto-resize */
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        /* File upload hover effects */
        .file-upload-zone:hover {
            background-color: #f8fafc;
        }
    </style>
</div>