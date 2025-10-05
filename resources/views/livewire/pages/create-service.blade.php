<div>
<div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl shadow-custom border border-gray-100">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-4">
            <i class="fas fa-clipboard-list text-2xl text-white"></i>
        </div>
        <h1 class="text-3xl font-bold grey-dark-text mb-2">طلب خدمة: {{ $serviceType->service_name_ar }}</h1>
        <p class="text-lg grey-medium-text">{{ $serviceType->description_ar }}</p>
    </div>

    <!-- Service Type Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-600 ml-2"></i>
                <span class="font-semibold text-blue-800">معلومات الخدمة:</span>
            </div>
            <div class="text-sm text-blue-700 space-x-4">
                <span>مدة المعالجة العادية: {{ $serviceType->processing_days }} أيام</span>
                @if($serviceType->allows_urgent)
                    <span>| مدة المعالجة العاجلة: {{ $serviceType->urgent_processing_days }} أيام</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Warning Message -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-yellow-400 ml-2"></i>
            <div class="text-yellow-700 font-medium">
                تحذير: يرجى التأكد من أن جميع البيانات والمستندات المقدمة صحيحة وقانونية. أي تلاعب أو تقديم معلومات غير صحيحة قد يعرضك للمساءلة القانونية.
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-400 ml-2"></i>
                <div class="text-green-700 font-medium">{{ session('message') }}</div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-400 ml-2"></i>
                <div class="text-red-700 font-medium">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <!-- Loading Overlay -->
    <div wire:loading.flex class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 text-center shadow-lg">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gold-primary mx-auto mb-4"></div>
            <p class="text-lg grey-dark-text">جاري إرسال الطلب...</p>
        </div>
    </div>

    <form wire:submit.prevent="confirmSubmit" class="space-y-8">

        <!-- Basic Information Section -->
        <div class="bg-gold-light bg-opacity-30 rounded-xl p-6 border border-gold-primary border-opacity-20">
            <h2 class="text-xl font-bold grey-dark-text mb-4 flex items-center">
                <i class="fas fa-info-circle gold-text ml-2"></i>
                المعلومات الأساسية
            </h2>
            
            <!-- Request Title -->
            <div class="space-y-2 mb-6">
                <label for="request_title" class="block text-sm font-bold grey-dark-text">
                    عنوان الطلب <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text" 
                           id="request_title" 
                           wire:model="request_title"
                           class="block w-full px-4 py-3 pr-12 border rounded-xl focus:outline-none focus:ring-2 transition-all duration-300 @error('request_title') border-red-300 focus:ring-red-500 @else border-gray-300 focus:ring-gold-primary @enderror"
                           placeholder="أدخل عنوان واضح للطلب"
                           maxlength="255">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-edit text-gray-400"></i>
                    </div>
                </div>
                @error('request_title')
                    <div class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Request Description -->
            <div class="space-y-2 mb-6">
                <label for="request_description" class="block text-sm font-bold grey-dark-text">
                    تفاصيل الطلب <span class="text-red-500">*</span>
                </label>
                <textarea id="request_description"
                          wire:model="request_description"
                          class="block w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 resize-none transition-all duration-300 @error('request_description') border-red-300 focus:ring-red-500 @else border-gray-300 focus:ring-gold-primary @enderror"
                          rows="6"
                          maxlength="1000"
                          placeholder="اشرح تفاصيل طلبك بوضوح..."></textarea>
                @error('request_description')
                    <div class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Case Reference (if required) -->
            @if($serviceType->requires_case_reference)
                <div class="space-y-2 mb-6">
                    <label for="related_case_id" class="block text-sm font-bold grey-dark-text">
                        رقم القضية <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="related_case_id" 
                               wire:model="related_case_id"
                               class="block w-full px-4 py-3 pr-12 border rounded-xl focus:outline-none focus:ring-2 transition-all duration-300 @error('related_case_id') border-red-300 focus:ring-red-500 @else border-gray-300 focus:ring-gold-primary @enderror"
                               placeholder="أدخل رقم القضية المرجعية">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-gavel text-gray-400"></i>
                        </div>
                    </div>
                    @error('related_case_id')
                        <div class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            @if (Auth::user()->hasRole('lawyer'))
                <!-- Customer National ID -->
                <div class="space-y-2 mb-6">
                    <label for="client_national_id" class="block text-sm font-bold grey-dark-text">
                        الرقم القومي للموكل <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="client_national_id"
                               wire:model="client_national_id"
                               class="block w-full px-4 py-3 pr-12 border rounded-xl focus:outline-none focus:ring-2 transition-all duration-300 @error('client_national_id') border-red-300 focus:ring-red-500 @else border-gray-300 focus:ring-gold-primary @enderror"
                               placeholder="أدخل الرقم القومي للموكل"
                               maxlength="14">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                    </div>
                    @error('client_national_id')
                        <div class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Power of Attorney -->
                <div class="space-y-2">
                    <label for="power_of_attorney" class="block text-sm font-bold grey-dark-text">
                        التوكيل <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed rounded-xl p-6 text-center transition-all duration-300 @if ($power_of_attorney) border-green-400 bg-green-50 @else @error('power_of_attorney') border-red-400 bg-red-50 @else border-gray-300 hover:border-gold-primary @enderror @endif">
                        <div class="space-y-3">
                            <i class="fas fa-cloud-upload-alt text-4xl @if ($power_of_attorney) text-green-500 @else text-gray-400 @endif"></i>
                            <div>
                                <label for="power_of_attorney"
                                       class="cursor-pointer font-medium transition-colors @if ($power_of_attorney) text-green-600 hover:text-green-500 @else text-gold-primary hover:text-gold-secondary @endif">
                                    <span>@if ($power_of_attorney) تغيير الملف @else اختر الملف @endif</span>
                                    <input type="file"
                                           id="power_of_attorney"
                                           wire:model="power_of_attorney"
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                           class="hidden">
                                </label>
                                @if (!$power_of_attorney)
                                    <span class="text-gray-600"> أو اسحب الملف هنا</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, JPEG, PNG حتى 10MB</p>
                        </div>
                    </div>
                    @error('power_of_attorney')
                        <div class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif
        </div>

        <!-- Service Options Section -->
        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
            <h2 class="text-xl font-bold grey-dark-text mb-6 flex items-center">
                <i class="fas fa-cogs gold-text ml-2"></i>
                خيارات الخدمة
            </h2>
            
            <!-- Urgent Service Option -->
            @if($serviceType->allows_urgent)
            <div class="space-y-4 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold grey-dark-text mb-2">خدمة عاجلة</h3>
                        <p class="text-sm grey-medium-text">معالجة الطلب بشكل أسرع مع رسوم إضافية</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               wire:model.live="is_urgent_service" 
                               class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gold-primary"></div>
                    </label>
                </div>

                @if($is_urgent_service)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-bolt text-yellow-600 ml-2"></i>
                            <span class="font-semibold text-yellow-800">معلومات الخدمة العاجلة:</span>
                        </div>
                        <div class="text-sm text-yellow-700 space-y-1">
                            <p>• مدة المعالجة: {{ $serviceType->urgent_processing_days }} يوم</p>
                            <p>• رسوم إضافية: {{ number_format($urgent_fees_amount, 2) }} جنيه ({{ $serviceType->urgent_fee_multiplier }}x)</p>
                            <p>• سيتم معالجة طلبك بأولوية عالية</p>
                        </div>
                    </div>
                @endif
            </div>
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-center">
                    <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                    <p class="text-gray-600">هذه الخدمة غير متاحة كخدمة عاجلة</p>
                </div>
            @endif

            <!-- Processing Time Information -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mt-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-blue-600 ml-2"></i>
                        <span class="font-semibold text-blue-800">مدة المعالجة المتوقعة:</span>
                    </div>
                    <span class="text-lg font-bold text-blue-800">{{ $rest_days }} أيام</span>
                </div>
                <p class="text-sm text-blue-700 mt-2">
                    @if($is_urgent_service)
                        خدمة عاجلة - سيتم الإنتهاء خلال {{ $serviceType->urgent_processing_days }} أيام عمل
                    @else
                        خدمة عادية - سيتم الإنتهاء خلال {{ $serviceType->processing_days }} أيام عمل
                    @endif
                </p>
            </div>

            <!-- Payment Information -->
            @if ($serviceType->is_prepaid_service)
            <div class="space-y-4 mt-6">
                <h3 class="text-lg font-semibold grey-dark-text mb-4">تفاصيل الرسوم والدفع</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Base Fees -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm grey-medium-text">الرسوم الأساسية:</span>
                            <span class="font-semibold text-green-600">{{ number_format($base_fees_amount, 2) }} ج.م</span>
                        </div>
                    </div>

                    <!-- Urgent Fees -->
                    @if($is_urgent_service)
                        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-yellow-700">رسوم الخدمة العاجلة:</span>
                                <span class="font-semibold text-yellow-600">+ {{ number_format($urgent_fees_amount, 2) }} ج.م</span>
                            </div>
                        </div>
                    @endif

                    <!-- Total Fees -->
                    <div class="md:col-span-2 bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-blue-800">المبلغ الإجمالي:</span>
                            <span class="text-xl font-bold text-blue-800">{{ number_format($total_fees_amount, 2) }} ج.م</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="space-y-3 mt-4">
                    <label class="block text-sm font-bold grey-dark-text">طريقة الدفع <span class="text-red-500">*</span></label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Online Payment -->
                        <label class="relative flex cursor-pointer">
                            <input type="radio" 
                                   wire:model.live="payment_method" 
                                   value="online" 
                                   class="sr-only peer">
                            <div class="w-full p-4 border-2 border-gray-300 rounded-xl peer-checked:border-gold-primary peer-checked:bg-gold-light bg-white transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 border-2 border-gray-300 rounded-full peer-checked:border-gold-primary peer-checked:bg-gold-primary flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold grey-dark-text">الدفع الإلكتروني</div>
                                        <div class="text-sm grey-medium-text">دفع فوري عبر البطاقات الإلكترونية</div>
                                    </div>
                                    <i class="fas fa-credit-card text-gray-400 text-lg mr-auto"></i>
                                </div>
                            </div>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="relative flex cursor-pointer">
                            <input type="radio" 
                                   wire:model.live="payment_method" 
                                   value="bank_transfer" 
                                   class="sr-only peer">
                            <div class="w-full p-4 border-2 border-gray-300 rounded-xl peer-checked:border-gold-primary peer-checked:bg-gold-light bg-white transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 border-2 border-gray-300 rounded-full peer-checked:border-gold-primary peer-checked:bg-gold-primary flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold grey-dark-text">التحويل البنكي</div>
                                        <div class="text-sm grey-medium-text">تحويل إلى حساب المحكمة</div>
                                    </div>
                                    <i class="fas fa-university text-gray-400 text-lg mr-auto"></i>
                                </div>
                            </div>
                        </label>
                    </div>

                    @error('payment_method')
                        <div class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            @else
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mt-4 text-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mb-2"></i>
                    <p class="text-green-700 font-medium">هذه الخدمة لا تتطلب دفع مقدم</p>
                </div>
            @endif
        </div>

        <!-- Document Upload Sections -->
        @if (!empty($serviceType->required_documents))
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <h3 class="text-xl font-bold grey-dark-text mb-6 flex items-center">
                    <i class="fas fa-folder-open gold-text ml-2"></i>
                    المستندات المطلوبة
                </h3>
                
                <div class="space-y-6">
                    @foreach ($serviceType->required_documents as $key => $doc)
                        <div class="space-y-3">
                            <label class="block text-sm font-bold grey-dark-text">
                                <i class="fas fa-paperclip gold-text ml-2"></i>
                                {{ $doc }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="border-2 border-dashed rounded-xl p-6 text-center transition-all duration-300 @if (isset($documents[$key])) border-green-400 bg-green-50 @else @error('documents.' . $key) border-red-400 bg-red-50 @else border-gray-300 hover:border-gold-primary @enderror @endif">
                                
                                <div class="space-y-3">
                                    <i class="fas fa-cloud-upload-alt text-4xl @if (isset($documents[$key])) text-green-500 @else text-gray-400 @endif"></i>
                                    <div>
                                        <label for="document_{{ $key }}" 
                                               class="cursor-pointer font-medium transition-colors @if (isset($documents[$key])) text-green-600 hover:text-green-500 @else text-gold-primary hover:text-gold-secondary @endif">
                                            <span>@if (isset($documents[$key])) تغيير الملف @else اختر الملف @endif</span>
                                            <input type="file" 
                                                   id="document_{{ $key }}" 
                                                   wire:model="documents.{{ $key }}" 
                                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
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
                                <div class="mt-3">
                                    <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded-xl p-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-check text-green-600 ml-2"></i>
                                            <span class="text-sm text-green-800 font-medium">{{ $documents[$key]->getClientOriginalName() }}</span>
                                            <span class="text-xs text-green-600 mr-2">({{ number_format($documents[$key]->getSize() / 1024, 1) }} KB)</span>
                                        </div>
                                        <button type="button" 
                                                wire:click="removeDocument('{{ $key }}')" 
                                                class="text-red-500 hover:text-red-700 transition-colors">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @error('documents.' . $key)
                                <div class="text-red-500 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle ml-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Summary and Submit -->
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
                            <span class="grey-medium-text">نوع الخدمة:</span>
                            <span class="font-medium grey-dark-text">{{ $serviceType->service_name_ar }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="grey-medium-text">نوع المعالجة:</span>
                            <span class="font-medium {{ $is_urgent_service ? 'text-yellow-600' : 'grey-dark-text' }}">
                                {{ $is_urgent_service ? 'خدمة عاجلة' : 'خدمة عادية' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="grey-medium-text">مدة المعالجة:</span>
                            <span class="font-medium text-blue-600">{{ $rest_days }} أيام</span>
                        </div>
                        @if($serviceType->is_prepaid_service)
                        <div class="flex justify-between">
                            <span class="grey-medium-text">طريقة الدفع:</span>
                            <span class="font-medium grey-dark-text">
                                @if($payment_method === 'online')
                                    إلكتروني
                                @elseif($payment_method === 'bank_transfer')
                                    تحويل بنكي
                                @else
                                    لم يتم الاختيار
                                @endif
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Cost Summary -->
                <div class="space-y-3">
                    <h4 class="font-semibold grey-dark-text">تفاصيل التكلفة:</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="grey-medium-text">الرسوم الأساسية:</span>
                            <span class="font-medium text-green-600">{{ number_format($base_fees_amount, 2) }} ج.م</span>
                        </div>
                        @if($is_urgent_service)
                            <div class="flex justify-between">
                                <span class="grey-medium-text">رسوم عاجلة:</span>
                                <span class="font-medium text-yellow-600">+ {{ number_format($urgent_fees_amount, 2) }} ج.م</span>
                            </div>
                        @endif
                        <div class="flex justify-between border-t border-gray-200 pt-2">
                            <span class="font-semibold grey-dark-text">المبلغ الإجمالي:</span>
                            <span class="font-bold text-blue-800 text-lg">{{ number_format($total_fees_amount, 2) }} ج.م</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-gray-200">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="w-full flex justify-center items-center px-8 py-4 text-lg font-bold rounded-xl text-white gold-bg hover:bg-gold-secondary focus:outline-none focus:ring-2 focus:ring-gold-primary transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg">
                    
                    <span wire:loading.remove wire:target="createServiceRequest" class="flex items-center">
                        <i class="fas fa-paper-plane ml-2"></i>
                        @if($serviceType->is_prepaid_service)
                            تأكيد والمتابعة للدفع
                        @else
                            تأكيد وإرسال الطلب
                        @endif
                    </span>
                    
                    <span wire:loading wire:target="createServiceRequest" class="flex items-center">
                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white ml-2"></div>
                        جاري الإرسال...
                    </span>
                </button>
            </div>
        </div>
    </form>

<!-- Submit Confirmation Modal -->
@if($showSubmitConfirmation)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 text-center">
        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
        </div>
        
        <h3 class="text-xl font-bold text-gray-800 mb-3">تأكيد إرسال الطلب</h3>
        
        <div class="text-gray-600 mb-6 text-right">
            <p class="mb-3">هل أنت متأكد من أن جميع البيانات والمستندات المقدمة صحيحة؟</p>
            <div class="bg-gray-50 rounded-lg p-3 text-sm">
                <p><strong>المبلغ الإجمالي:</strong> {{ number_format($total_fees_amount, 2) }} ج.م</p>
                <p><strong>مدة المعالجة:</strong> {{ $rest_days }} أيام</p>
            </div>
        </div>
        
        <div class="flex gap-3">
            <button type="button" 
                    wire:click="$set('showSubmitConfirmation', false)"
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                إلغاء
            </button>
            <button type="button" 
                    wire:click="createServiceRequest"
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                تأكيد
            </button>
        </div>
    </div>
</div>
@endif

    <!-- Help Section -->
    <div class="mt-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
        <h4 class="text-lg font-semibold grey-dark-text mb-3 flex items-center">
            <i class="fas fa-question-circle gold-text ml-1"></i>
            تحتاج مساعدة؟
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm grey-medium-text">
            <div class="space-y-2">
                <p class="flex items-center"><i class="fas fa-circle text-xs gold-text ml-2"></i> املأ العنوان والوصف بوضوح</p>
                <p class="flex items-center"><i class="fas fa-circle text-xs gold-text ml-2"></i> أرفق المستندات المطلوبة</p>
                <p class="flex items-center"><i class="fas fa-circle text-xs gold-text ml-2"></i> اختر نوع الخدمة المناسب</p>
            </div>
            <div class="space-y-2">
                <p class="flex items-center"><i class="fas fa-circle text-xs gold-text ml-2"></i> سيتم إشعارك بحالة الطلب عبر البريد</p>
                <p class="flex items-center"><i class="fas fa-circle text-xs gold-text ml-2"></i> مدة المعالجة: {{ $rest_days }} أيام عمل</p>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-200">
            <p class="text-sm grey-medium-text text-center">
                للمساعدة الفنية: <span class="text-blue-600 font-medium">support@court.gov.eg</span> | 
                الهاتف: <span class="text-blue-600 font-medium">16000</span>
            </p>
        </div>
    </div>
</div>
</div>