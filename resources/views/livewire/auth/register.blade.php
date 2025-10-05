<div class="min-h-screen flex items-center justify-center bg-[#F8FAFC] py-8" x-data="registrationForm()" x-init="init()">
    <div class="w-full max-w-2xl p-8 space-y-6 bg-white rounded-2xl shadow-custom border border-gray-100 mx-4">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-4 shadow-lg">
                <i class="fas fa-balance-scale text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold grey-dark-text mb-2">إنشاء حساب جديد</h1>
            <p class="text-lg grey-medium-text">انضم إلى نظام محكمة النقض الإلكتروني</p>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
            <div class="gold-bg h-2 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
        </div>

        <!-- Display validation errors -->
        <div x-show="Object.keys(errors).length > 0" 
             x-transition
             class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-400 ml-2"></i>
                <div>
                    <h3 class="text-sm font-medium text-red-800">يرجى تصحيح الأخطاء التالية:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            <template x-for="(error, field) in errors" :key="field">
                                <li x-text="error"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="register" class="space-y-6">

            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="first_name" class="block text-sm font-bold grey-dark-text">
                        <i class="fas fa-user gold-text ml-2"></i>
                        الاسم الأول <span class="text-red-500">*</span>
                    </label>
                    <input id="first_name" 
                           type="text" 
                           wire:model.live="first_name" 
                           x-model="form.first_name"
                           @blur="validateField('first_name')"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="أدخل الاسم الأول"
                           autofocus 
                           autocomplete="given-name">
                    @error('first_name') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="last_name" class="block text-sm font-bold grey-dark-text">
                        <i class="fas fa-user gold-text ml-2"></i>
                        الاسم الأخير <span class="text-red-500">*</span>
                    </label>
                    <input id="last_name" 
                           type="text" 
                           wire:model.live="last_name" 
                           x-model="form.last_name"
                           @blur="validateField('last_name')"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="أدخل الاسم الأخير"
                           autocomplete="family-name">
                    @error('last_name') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-bold grey-dark-text">
                    <i class="fas fa-envelope gold-text ml-2"></i>
                    البريد الإلكتروني <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input id="email" 
                           type="email" 
                           wire:model.live="email" 
                           x-model="form.email"
                           @blur="validateField('email')"
                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="example@email.com"
                           autocomplete="email">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                @error('email') 
                    <span class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- National ID & Phone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="national_id" class="block text-sm font-bold grey-dark-text">
                        <i class="fas fa-id-card gold-text ml-2"></i>
                        الرقم القومي <span class="text-red-500">*</span>
                    </label>
                    <input id="national_id" 
                           type="text" 
                           wire:model.live="national_id" 
                           x-model="form.national_id"
                           @input="form.national_id = form.national_id.replace(/[^0-9]/g, '').substring(0, 14)"
                           @blur="validateField('national_id')"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="14 رقم"
                           maxlength="14"
                           autocomplete="off">
                    @error('national_id') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="phone" class="block text-sm font-bold grey-dark-text">
                        <i class="fas fa-phone gold-text ml-2"></i>
                        رقم الهاتف <span class="text-red-500">*</span>
                    </label>
                    <input id="phone" 
                           type="text" 
                           wire:model.live="phone" 
                           x-model="form.phone"
                           @input="form.phone = form.phone.replace(/[^0-9+]/g, '')"
                           @blur="validateField('phone')"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="01xxxxxxxxx"
                           autocomplete="tel">
                    @error('phone') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Address Info -->
            <div class="space-y-2">
                <label for="address" class="block text-sm font-bold grey-dark-text">
                    <i class="fas fa-home gold-text ml-2"></i>
                    العنوان
                </label>
                <input id="address" 
                       type="text" 
                       wire:model.live="address" 
                       x-model="form.address"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                       placeholder="رقم المنزل - الشارع - الحي">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label for="city" class="block text-sm font-bold grey-dark-text">
                        المدينة
                    </label>
                    <input id="city" 
                           type="text" 
                           wire:model.live="city" 
                           x-model="form.city"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                           placeholder="أدخل المدينة">
                </div>
                <div class="space-y-2">
                    <label for="governorate" class="block text-sm font-bold grey-dark-text">
                        المحافظة
                    </label>
                    <select id="governorate" 
                            wire:model.live="governorate" 
                            x-model="form.governorate"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                        <option value="">اختر المحافظة</option>
                        <option value="cairo">القاهرة</option>
                        <option value="giza">الجيزة</option>
                        <option value="alexandria">الإسكندرية</option>
                        <!-- Add other governorates -->
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="zipcode" class="block text-sm font-bold grey-dark-text">
                        الرمز البريدي
                    </label>
                    <input id="zipcode" 
                           type="text" 
                           wire:model.live="zipcode" 
                           x-model="form.zipcode"
                           @input="form.zipcode = form.zipcode.replace(/[^0-9]/g, '').substring(0, 5)"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                           placeholder="12345"
                           maxlength="5">
                </div>
            </div>

            <!-- Role Selection -->
            <div class="space-y-3">
                <label class="block text-sm font-bold grey-dark-text">
                    <i class="fas fa-user-tag gold-text ml-2"></i>
                    نوع المستخدم <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" 
                               wire:model.live="role" 
                               x-model="form.role"
                               value="litigant" 
                               class="sr-only peer">
                        <div class="p-4 border-2 border-gray-300 rounded-xl cursor-pointer transition-all duration-300 hover:border-gold-primary hover:bg-amber-50 peer-checked:border-gold-primary peer-checked:bg-amber-50 peer-checked:ring-2 peer-checked:ring-gold-primary peer-checked:ring-opacity-20">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center ml-3">
                                    <i class="fas fa-user gold-text"></i>
                                </div>
                                <div>
                                    <div class="font-bold grey-dark-text">متقاضي</div>
                                    <div class="text-sm grey-medium-text mt-1">للمواطنين العاديين</div>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" 
                               wire:model.live="role" 
                               x-model="form.role"
                               value="lawyer" 
                               class="sr-only peer">
                        <div class="p-4 border-2 border-gray-300 rounded-xl cursor-pointer transition-all duration-300 hover:border-gold-primary hover:bg-amber-50 peer-checked:border-gold-primary peer-checked:bg-amber-50 peer-checked:ring-2 peer-checked:ring-gold-primary peer-checked:ring-opacity-20">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center ml-3">
                                    <i class="fas fa-briefcase gold-text"></i>
                                </div>
                                <div>
                                    <div class="font-bold grey-dark-text">محامي</div>
                                    <div class="text-sm grey-medium-text mt-1">للمحامين المرخصين</div>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                @error('role') 
                    <span class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- Lawyer Extra Fields -->
            <div x-show="form.role === 'lawyer'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="p-6 bg-amber-50 border border-amber-200 rounded-xl space-y-4">
                
                <div class="flex items-center mb-4">
                    <i class="fas fa-gavel gold-text text-lg ml-2"></i>
                    <h3 class="text-lg font-bold grey-dark-text">بيانات المحاماة</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="bar_registration_number" class="block text-sm font-bold grey-dark-text">
                            رقم القيد بالنقابة <span class="text-red-500">*</span>
                        </label>
                        <input id="bar_registration_number" 
                               type="text" 
                               wire:model.live="bar_registration_number" 
                               x-model="form.bar_registration_number"
                               @blur="validateField('bar_registration_number')"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                               placeholder="رقم القيد في النقابة">
                        @error('bar_registration_number') 
                            <span class="text-red-500 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="specialization" class="block text-sm font-bold grey-dark-text">
                            التخصص <span class="text-red-500">*</span>
                        </label>
                        <select id="specialization" 
                                wire:model.live="specialization" 
                                x-model="form.specialization"
                                @blur="validateField('specialization')"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="">اختر التخصص</option>
                            <option value="civil">القانون المدني</option>
                            <option value="criminal">القانون الجنائي</option>
                            <option value="commercial">القانون التجاري</option>
                            <option value="administrative">القانون الإداري</option>
                            <option value="labor">قانون العمل</option>
                            <option value="family">قانون الأسرة</option>
                        </select>
                        @error('specialization') 
                            <span class="text-red-500 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </span> 
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="bar_registration_image" class="block text-sm font-bold grey-dark-text">
                        صورة بطاقة المحاماة <span class="text-red-500">*</span>
                    </label>
                    <div x-show="!imagePreview" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center transition-all duration-300 hover:border-gold-primary hover:bg-amber-50">
                        <div class="space-y-3">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                            <div>
                                <label for="bar_registration_image" class="cursor-pointer font-medium text-gold-primary hover:text-gold-secondary transition-colors">
                                    <span>اختر ملف صورة البطاقة</span>
                                    <input type="file" 
                                           id="bar_registration_image" 
                                           wire:model.live="bar_registration_image" 
                                           @change="handleFileUpload($event)"
                                           accept="image/*"
                                           class="hidden">
                                </label>
                                <span class="text-gray-600"> أو اسحب الملف هنا</span>
                            </div>
                            <p class="text-xs text-gray-500">JPG, PNG, GIF حتى 10MB</p>
                        </div>
                    </div>
                    <div x-show="imagePreview" class="text-center">
                        <img :src="imagePreview" class="mx-auto h-32 rounded-md shadow-md">
                        <button @click="removeImage" type="button" class="mt-2 text-sm text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt ml-1"></i>
                            إزالة الصورة
                        </button>
                    </div>
                    @error('bar_registration_image') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-bold grey-dark-text">
                        <i class="fas fa-lock gold-text ml-2"></i>
                        كلمة المرور <span class="text-red-500">*</span>
                    </label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <input id="password" 
                               :type="showPassword ? 'text' : 'password'" 
                               wire:model.live="password" 
                               x-model="form.password"
                               @input="checkPasswordStrength"
                               @blur="validateField('password')"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                               placeholder="أدخل كلمة مرور قوية"
                               autocomplete="new-password">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gold-primary transition-colors duration-300">
                            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex space-x-1 space-x-reverse">
                            <div :class="passwordStrength >= 1 ? 'bg-red-500' : 'bg-gray-200'" 
                                 class="h-1 w-1/4 rounded transition-colors duration-300"></div>
                            <div :class="passwordStrength >= 2 ? 'bg-yellow-500' : 'bg-gray-200'" 
                                 class="h-1 w-1/4 rounded transition-colors duration-300"></div>
                            <div :class="passwordStrength >= 3 ? 'bg-blue-500' : 'bg-gray-200'" 
                                 class="h-1 w-1/4 rounded transition-colors duration-300"></div>
                            <div :class="passwordStrength >= 4 ? 'bg-green-500' : 'bg-gray-200'" 
                                 class="h-1 w-1/4 rounded transition-colors duration-300"></div>
                        </div>
                        <p class="text-xs mt-1 text-gray-500" x-text="passwordStrengthText"></p>
                    </div>
                    
                    @error('password') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
                
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-bold grey-dark-text">
                        <i class="fas fa-lock gold-text ml-2"></i>
                        تأكيد كلمة المرور <span class="text-red-500">*</span>
                    </label>
                    <div class="relative" x-data="{ showPasswordConfirm: false }">
                        <input id="password_confirmation" 
                               :type="showPasswordConfirm ? 'text' : 'password'" 
                               wire:model.live="password_confirmation" 
                               x-model="form.password_confirmation"
                               @blur="validateField('password_confirmation')"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                               placeholder="أعد إدخال كلمة المرور"
                               autocomplete="new-password">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <button type="button" 
                                @click="showPasswordConfirm = !showPasswordConfirm"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gold-primary transition-colors duration-300">
                            <i :class="showPasswordConfirm ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                    @error('password_confirmation') 
                        <span class="text-red-500 text-sm flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" 
                        wire:loading.attr="disabled"
                        :disabled="loading"
                        class="w-full gold-bg hover:bg-gold-secondary text-white py-4 px-6 rounded-xl font-bold focus:outline-none focus:ring-2 focus:ring-gold-primary focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                    
                    <span wire:loading.remove class="flex items-center">
                        <i class="fas fa-user-plus"></i>
                        إنشاء حساب
                    </span>
                    
                    <span wire:loading class="flex items-center">
                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                        جاري التسجيل...
                    </span>
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm grey-medium-text">
                    لديك حساب بالفعل؟ 
                    <a class="gold-text hover:text-gold-secondary font-bold transition-colors duration-300 mr-1" href="{{ route('login') }}" wire:navigate>
                        سجل الدخول هنا
                    </a>
                </p>
            </div>
        </form>

        <!-- Help Section -->
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200 text-center">
            <p class="text-sm grey-medium-text mb-2">هل تحتاج مساعدة في التسجيل؟</p>
            <div class="flex flex-col sm:flex-row gap-2 justify-center text-xs">
                <a href="mailto:support@cassation.gov.eg" class="gold-text hover:text-gold-secondary transition-colors">
                    <i class="fas fa-envelope ml-1"></i>
                    support@cassation.gov.eg
                </a>
                <span class="hidden sm:block text-gray-400">|</span>
                <a href="tel:16000" class="gold-text hover:text-gold-secondary transition-colors">
                    <i class="fas fa-phone ml-1"></i>
                    16000
                </a>
            </div>
        </div>
    </div>

    <script>
        function registrationForm() {
            return {
                // Form data
                form: {
                    first_name: @entangle('first_name'),
                    last_name: @entangle('last_name'),
                    email: @entangle('email'),
                    national_id: @entangle('national_id'),
                    phone: @entangle('phone'),
                    address: @entangle('address'),
                    city: @entangle('city'),
                    governorate: @entangle('governorate'),
                    zipcode: @entangle('zipcode'),
                    role: @entangle('role'),
                    bar_registration_number: @entangle('bar_registration_number'),
                    specialization: @entangle('specialization'),
                    bar_registration_image: @entangle('bar_registration_image'),
                    password: @entangle('password'),
                    password_confirmation: @entangle('password_confirmation')
                },
                
                // UI state
                errors: {},
                loading: false,
                progress: 0,
                showPassword: false,
                showPasswordConfirm: false,
                passwordStrength: 0,
                passwordStrengthText: '',
                imagePreview: null,

                init() {
                    this.updateProgress();
                    this.$watch('form', () => {
                        this.updateProgress();
                    });
                },

                updateProgress() {
                    const totalFields = 12;
                    let filledFields = 0;
                    
                    Object.keys(this.form).forEach(key => {
                        if (key === 'bar_registration_number' || key === 'specialization' || key === 'bar_registration_image') {
                            if (this.form.role === 'lawyer' && this.form[key]) filledFields++;
                        } else if (this.form[key]) {
                            filledFields++;
                        }
                    });
                    
                    this.progress = Math.round((filledFields / totalFields) * 100);
                },

                validateField(fieldName) {
                    this.errors = { ...this.errors };
                    delete this.errors[fieldName];

                    const value = this.form[fieldName];
                    
                    switch(fieldName) {
                        case 'first_name':
                        case 'last_name':
                            if (!value || value.trim() === '') {
                                this.errors[fieldName] = 'هذا الحقل مطلوب';
                            } else if (value.length < 2) {
                                this.errors[fieldName] = 'يجب أن يكون أكثر من حرفين';
                            }
                            break;
                        case 'email':
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!value) {
                                this.errors[fieldName] = 'البريد الإلكتروني مطلوب';
                            } else if (!emailRegex.test(value)) {
                                this.errors[fieldName] = 'البريد الإلكتروني غير صحيح';
                            }
                            break;
                        case 'national_id':
                            if (!value) {
                                this.errors[fieldName] = 'الرقم القومي مطلوب';
                            } else if (value.length !== 14) {
                                this.errors[fieldName] = 'الرقم القومي يجب أن يكون 14 رقم';
                            }
                            break;
                        case 'phone':
                            const phoneRegex = /^(01)[0-9]{9}$/;
                            if (!value) {
                                this.errors[fieldName] = 'رقم الهاتف مطلوب';
                            } else if (!phoneRegex.test(value)) {
                                this.errors[fieldName] = 'رقم الهاتف غير صحيح (يجب أن يبدأ بـ 01 ويكون 11 رقم)';
                            }
                            break;
                        case 'bar_registration_number':
                            if (this.form.role === 'lawyer' && (!value || value.trim() === '')) {
                                this.errors[fieldName] = 'رقم القيد مطلوب للمحامين';
                            }
                            break;
                        case 'specialization':
                            if (this.form.role === 'lawyer' && (!value || value.trim() === '')) {
                                this.errors[fieldName] = 'التخصص مطلوب للمحامين';
                            }
                            break;
                        case 'password':
                            if (!value) {
                                this.errors[fieldName] = 'كلمة المرور مطلوبة';
                            } else if (value.length < 8) {
                                this.errors[fieldName] = 'كلمة المرور يجب أن تكون 8 أحرف على الأقل';
                            }
                            break;
                        case 'password_confirmation':
                            if (!value) {
                                this.errors[fieldName] = 'تأكيد كلمة المرور مطلوب';
                            } else if (value !== this.form.password) {
                                this.errors[fieldName] = 'كلمة المرور غير متطابقة';
                            }
                            break;
                    }
                },

                checkPasswordStrength() {
                    const password = this.form.password;
                    let strength = 0;
                    
                    if (password.length >= 8) strength++;
                    if (/[a-z]/.test(password)) strength++;
                    if (/[A-Z]/.test(password)) strength++;
                    if (/[0-9]/.test(password)) strength++;
                    if (/[^A-Za-z0-9]/.test(password)) strength++;
                    
                    this.passwordStrength = strength;
                    
                    switch(strength) {
                        case 0:
                        case 1:
                            this.passwordStrengthText = 'ضعيفة جداً';
                            break;
                        case 2:
                            this.passwordStrengthText = 'ضعيفة';
                            break;
                        case 3:
                            this.passwordStrengthText = 'متوسطة';
                            break;
                        case 4:
                            this.passwordStrengthText = 'قوية';
                            break;
                        case 5:
                            this.passwordStrengthText = 'قوية جداً';
                            break;
                        default:
                            this.passwordStrengthText = '';
                    }
                },

                handleFileUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const maxSize = 10 * 1024 * 1024; // 10MB
                        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                        
                        if (!allowedTypes.includes(file.type)) {
                            alert('نوع الملف غير مدعوم. يرجى رفع صورة بصيغة JPG, PNG أو GIF');
                            event.target.value = '';
                            this.form.bar_registration_image = null;
                            this.imagePreview = null;
                            return;
                        }
                        
                        if (file.size > maxSize) {
                            alert('حجم الملف كبير جداً. الحد الأقصى 10 ميجابايت');
                            event.target.value = '';
                            this.form.bar_registration_image = null;
                            this.imagePreview = null;
                            return;
                        }
                        
                        // File is valid, show preview
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removeImage() {
                    this.form.bar_registration_image = null;
                    this.imagePreview = null;
                    document.getElementById('bar_registration_image').value = '';
                }
            }
        }
    </script>

    <style>
        .gold-bg {
            background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
        }
        
        .gold-text {
            color: #D4AF37;
        }
        
        .grey-dark-text {
            color: #2D3748;
        }
        
        .grey-medium-text {
            color: #718096;
        }
        
        .shadow-custom {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Custom radio styling */
        input[type="radio"]:checked + div {
            border-color: #D4AF37;
            background-color: #FEF3C7;
        }
        
        /* Focus styles */
        input:focus, select:focus {
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }
        
        /* Smooth transitions */
        * {
            transition-property: color, background-color, border-color, transform, box-shadow;
            transition-duration: 300ms;
        }
        
        [x-cloak] { display: none !important; }
    </style>
</div>