<div class="min-h-screen flex items-center justify-center bg-gray-100" x-data="registrationForm()" x-init="init()">
    <div class="w-full max-w-2xl p-8 space-y-6 bg-white rounded-lg shadow-lg">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <i class="fas fa-balance-scale text-2xl text-blue-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">محكمة النقض المصرية</h1>
            <p class="text-gray-600">إنشاء حساب جديد</p>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
        </div>

        <!-- Display validation errors -->
        <div x-show="Object.keys(errors).length > 0" 
             x-transition
             class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
            <div class="flex">
                <i class="fas fa-exclamation-triangle text-red-400 ml-2 mt-1"></i>
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
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                        الاسم الأول <span class="text-red-500">*</span>
                    </label>
                    <input id="first_name" 
                           type="text" 
                           wire:model.live="first_name" 
                           x-model="form.first_name"
                           @blur="validateField('first_name')"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="أدخل الاسم الأول"
                           autofocus 
                           autocomplete="given-name">
                    @error('first_name') 
                        <span class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                        الاسم الأخير <span class="text-red-500">*</span>
                    </label>
                    <input id="last_name" 
                           type="text" 
                           wire:model.live="last_name" 
                           x-model="form.last_name"
                           @blur="validateField('last_name')"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="أدخل الاسم الأخير"
                           autocomplete="family-name">
                    @error('last_name') 
                        <span class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    البريد الإلكتروني <span class="text-red-500">*</span>
                </label>
                <input id="email" 
                       type="email" 
                       wire:model.live="email" 
                       x-model="form.email"
                       @blur="validateField('email')"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="example@email.com"
                       autocomplete="email">
                @error('email') 
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- National ID -->
            <div>
                <label for="national_id" class="block text-sm font-medium text-gray-700 mb-1">
                    الرقم القومي <span class="text-red-500">*</span>
                </label>
                <input id="national_id" 
                       type="text" 
                       wire:model.live="national_id" 
                       x-model="form.national_id"
                       @input="form.national_id = form.national_id.replace(/[^0-9]/g, '').substring(0, 14)"
                       @blur="validateField('national_id')"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="14 رقم"
                       maxlength="14"
                       autocomplete="off">
                @error('national_id') 
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                    رقم الهاتف <span class="text-red-500">*</span>
                </label>
                <input id="phone" 
                       type="text" 
                       wire:model.live="phone" 
                       x-model="form.phone"
                       @input="form.phone = form.phone.replace(/[^0-9+]/g, '')"
                       @blur="validateField('phone')"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="01xxxxxxxxx"
                       autocomplete="tel">
                @error('phone') 
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- Address Info -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                    العنوان
                </label>
                <input id="address" 
                       type="text" 
                       wire:model.live="address" 
                       x-model="form.address"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       placeholder="رقم المنزل - الشارع - الحي">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                        المدينة
                    </label>
                    <input id="city" 
                           type="text" 
                           wire:model.live="city" 
                           x-model="form.city"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="أدخل المدينة">
                </div>
                <div>
                    <label for="governorate" class="block text-sm font-medium text-gray-700 mb-1">
                        المحافظة
                    </label>
                    <select id="governorate" 
                            wire:model.live="governorate" 
                            x-model="form.governorate"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">اختر المحافظة</option>
                        <option value="cairo">القاهرة</option>
                        <option value="giza">الجيزة</option>
                        <option value="alexandria">الإسكندرية</option>
                        <option value="qalyubia">القليوبية</option>
                        <option value="dakahlia">الدقهلية</option>
                        <option value="sharqia">الشرقية</option>
                        <option value="gharbia">الغربية</option>
                        <option value="kafr_el_sheikh">كفر الشيخ</option>
                        <option value="beheira">البحيرة</option>
                        <option value="monufia">المنوفية</option>
                        <option value="damietta">دمياط</option>
                        <option value="port_said">بورسعيد</option>
                        <option value="ismailia">الإسماعيلية</option>
                        <option value="suez">السويس</option>
                        <option value="north_sinai">شمال سيناء</option>
                        <option value="south_sinai">جنوب سيناء</option>
                        <option value="red_sea">البحر الأحمر</option>
                        <option value="matrouh">مطروح</option>
                        <option value="fayyum">الفيوم</option>
                        <option value="beni_suef">بني سويف</option>
                        <option value="minya">المنيا</option>
                        <option value="asyut">أسيوط</option>
                        <option value="sohag">سوهاج</option>
                        <option value="qena">قنا</option>
                        <option value="luxor">الأقصر</option>
                        <option value="aswan">أسوان</option>
                        <option value="new_valley">الوادي الجديد</option>
                    </select>
                </div>
                <div>
                    <label for="zipcode" class="block text-sm font-medium text-gray-700 mb-1">
                        الرمز البريدي
                    </label>
                    <input id="zipcode" 
                           type="text" 
                           wire:model.live="zipcode" 
                           x-model="form.zipcode"
                           @input="form.zipcode = form.zipcode.replace(/[^0-9]/g, '').substring(0, 5)"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="12345"
                           maxlength="5">
                </div>
            </div>

            <!-- Role Selection -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                    الدور <span class="text-red-500">*</span>
                </label>
                <div class="mt-2 space-y-3">
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                        <input type="radio" 
                               wire:model.live="role" 
                               x-model="form.role"
                               value="litigant" 
                               class="text-blue-600 focus:ring-blue-500 border-gray-300 ml-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center ml-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">متقاضي</div>
                                <div class="text-sm text-gray-500">للمواطنين العاديين</div>
                            </div>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                        <input type="radio" 
                               wire:model.live="role" 
                               x-model="form.role"
                               value="lawyer" 
                               class="text-blue-600 focus:ring-blue-500 border-gray-300 ml-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center ml-3">
                                <i class="fas fa-briefcase text-purple-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">محامي</div>
                                <div class="text-sm text-gray-500">للمحامين المرخصين</div>
                            </div>
                        </div>
                    </label>
                </div>
                @error('role') 
                    <span class="text-red-500 text-sm mt-1 flex items-center">
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
                 class="space-y-4 p-6 bg-purple-50 border border-purple-200 rounded-lg">
                
                <div class="flex items-center mb-4">
                    <i class="fas fa-gavel text-purple-600 text-lg ml-2"></i>
                    <h3 class="text-lg font-semibold text-gray-800">بيانات المحاماة</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="bar_registration_number" class="block text-sm font-medium text-gray-700 mb-1">
                            رقم القيد بالنقابة <span class="text-red-500">*</span>
                        </label>
                        <input id="bar_registration_number" 
                               type="text" 
                               wire:model.live="bar_registration_number" 
                               x-model="form.bar_registration_number"
                               @blur="validateField('bar_registration_number')"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="رقم القيد في النقابة">
                        @error('bar_registration_number') 
                            <span class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div>
                        <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1">
                            التخصص <span class="text-red-500">*</span>
                        </label>
                        <select id="specialization" 
                                wire:model.live="specialization" 
                                x-model="form.specialization"
                                @blur="validateField('specialization')"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">اختر التخصص</option>
                            <option value="civil">القانون المدني</option>
                            <option value="criminal">القانون الجنائي</option>
                            <option value="commercial">القانون التجاري</option>
                            <option value="administrative">القانون الإداري</option>
                            <option value="labor">قانون العمل</option>
                            <option value="family">قانون الأسرة</option>
                            <option value="tax">القانون الضريبي</option>
                            <option value="constitutional">القانون الدستوري</option>
                            <option value="international">القانون الدولي</option>
                            <option value="other">أخرى</option>
                        </select>
                        @error('specialization') 
                            <span class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </span> 
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="bar_registration_image" class="block text-sm font-medium text-gray-700 mb-1">
                        صورة كارنيه النقابة <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-purple-400 transition-colors duration-300">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="bar_registration_image" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none">
                                    <span>رفع صورة</span>
                                    <input id="bar_registration_image" 
                                           type="file" 
                                           wire:model.live="bar_registration_image" 
                                           @change="handleFileUpload($event)"
                                           accept="image/*"
                                           class="sr-only">
                                </label>
                                <p class="pr-1">أو اسحب واسقط</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG حتى 5MB</p>
                        </div>
                    </div>
                    @error('bar_registration_image') 
                        <span class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        كلمة المرور <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input id="password" 
                               :type="showPassword ? 'text' : 'password'" 
                               wire:model.live="password" 
                               x-model="form.password"
                               @input="checkPasswordStrength"
                               @blur="validateField('password')"
                               class="mt-1 block w-full px-3 py-2 pl-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="أدخل كلمة مرور قوية"
                               autocomplete="new-password">
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
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
                        <span class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        تأكيد كلمة المرور <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" 
                               :type="showPasswordConfirm ? 'text' : 'password'" 
                               wire:model.live="password_confirmation" 
                               x-model="form.password_confirmation"
                               @blur="validateField('password_confirmation')"
                               class="mt-1 block w-full px-3 py-2 pl-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="أعد إدخال كلمة المرور"
                               autocomplete="new-password">
                        <button type="button" 
                                @click="showPasswordConfirm = !showPasswordConfirm"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i :class="showPasswordConfirm ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                    @error('password_confirmation') 
                        <span class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6">
                <a class="text-sm text-blue-600 hover:text-blue-500 transition-colors duration-200" href="{{ route('login') }}" wire:navigate>
                    لديك حساب بالفعل؟
                </a>

                <button type="submit" 
                        wire:loading.attr="disabled"
                        :disabled="loading"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                    <span wire:loading.remove>
                        <i class="fas fa-user-plus ml-2"></i>
                        إنشاء حساب
                    </span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin ml-2"></i>
                        جاري التسجيل...
                    </span>
                </button>
            </div>

        </form>
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
                        const maxSize = 5 * 1024 * 1024; // 5MB
                        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                        
                        if (!allowedTypes.includes(file.type)) {
                            alert('نوع الملف غير مدعوم. يرجى رفع صورة بصيغة JPG أو PNG');
                            event.target.value = '';
                            return;
                        }
                        
                        if (file.size > maxSize) {
                            alert('حجم الملف كبير جداً. الحد الأقصى 5 ميجابايت');
                            event.target.value = '';
                            return;
                        }
                        
                        // File is valid
                        this.form.bar_registration_image = file;
                    }
                },

                submitForm() {
                    this.loading = true;
                    
                    // Validate all fields before submit
                    Object.keys(this.form).forEach(field => {
                        this.validateField(field);
                    });
                    
                    // If no errors, the form will be submitted by Livewire
                    if (Object.keys(this.errors).length === 0) {
                        // Form will be submitted automatically
                        setTimeout(() => {
                            this.loading = false;
                        }, 2000);
                    } else {
                        this.loading = false;
                    }
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
        
        /* File upload styling */
        .file-upload-zone {
            transition: all 0.3s ease;
        }
        
        .file-upload-zone:hover {
            border-color: #8B5CF6;
            background-color: #F3F4F6;
        }
        
        /* Password strength colors */
        .strength-weak { color: #EF4444; }
        .strength-fair { color: #F59E0B; }
        .strength-good { color: #3B82F6; }
        .strength-strong { color: #10B981; }
    </style>
</div>
