<div>
<div class="min-h-screen flex items-center justify-center bg-[#F8FAFC] py-8">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-custom border border-gray-100">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-4 shadow-lg">
                <i class="fas fa-gavel text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold grey-dark-text mb-2">تسجيل الدخول</h1>
            <p class="text-lg grey-medium-text">مرحباً بعودتك إلى نظام محكمة النقض</p>
        </div>

        @if (session('status'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 ml-2"></i>
                    <span class="text-green-700 font-medium">{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <!-- Display validation errors -->
        @error('email')
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-400 ml-2"></i>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">خطأ في تسجيل الدخول</h3>
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    </div>
                </div>
            </div>
        @enderror

        <form wire:submit.prevent="login" class="space-y-6">

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-bold grey-dark-text">
                    <i class="fas fa-envelope gold-text ml-2"></i>
                    البريد الإلكتروني <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input id="email" 
                           wire:model="email" 
                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="example@email.com"
                           autofocus 
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

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-bold grey-dark-text">
                    <i class="fas fa-lock gold-text ml-2"></i>
                    كلمة المرور <span class="text-red-500">*</span>
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <input id="password" 
                           :type="showPassword ? 'text' : 'password'" 
                           wire:model="password" 
                           class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300" 
                           placeholder="أدخل كلمة المرور"
                           autocomplete="current-password">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </div>
                    <button type="button" 
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gold-primary transition-colors duration-300">
                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
                @error('password') 
                    <span class="text-red-500 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" 
                           type="checkbox" 
                           wire:model.defer="remember" 
                           class="w-4 h-4 text-gold-primary focus:ring-gold-primary border-gray-300 rounded transition-all duration-300">
                    <label for="remember_me" class="mr-2 block text-sm grey-dark-text cursor-pointer">
                        تذكرني
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm gold-text hover:text-gold-secondary transition-colors duration-300 font-medium" href="{{ route('password.request') }}">
                        هل نسيت كلمة المرور؟
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full gold-bg hover:bg-gold-secondary text-white py-4 px-6 rounded-xl font-bold focus:outline-none focus:ring-2 focus:ring-gold-primary focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                    
                    <span wire:loading.remove wire:target="login" class="flex items-center">
                        <i class="fas fa-sign-in-alt"></i>
                        تسجيل الدخول
                    </span>
                    
                    <span wire:loading wire:target="login" class="flex items-center">
                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                        جاري الدخول...
                    </span>
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm grey-medium-text">
                    ليس لديك حساب؟ 
                    <a class="gold-text hover:text-gold-secondary font-bold transition-colors duration-300 mr-1" href="{{ route('register') }}" wire:navigate>
                        إنشاء حساب جديد
                    </a>
                </p>
            </div>
        </form>

        <!-- Help Section -->
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200 text-center">
            <p class="text-sm grey-medium-text mb-2">هل تواجه مشكلة في الدخول؟</p>
            <div class="flex flex-col sm:flex-row gap-2 justify-center text-xs">
                <a href="mailto:support@cassation.gov.eg" class="text-gold-primary hover:text-gold-secondary transition-colors">
                    <i class="fas fa-envelope ml-1"></i>
                    support@cassation.gov.eg
                </a>
                <span class="hidden sm:block text-gray-400">|</span>
                <a href="tel:16000" class="text-gold-primary hover:text-gold-secondary transition-colors">
                    <i class="fas fa-phone ml-1"></i>
                    16000
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom checkbox styling */
    input[type="checkbox"]:checked {
        background-color: #D4AF37;
        border-color: #D4AF37;
    }
    
    /* Focus styles */
    input:focus {
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }
    
    /* Smooth transitions for all interactive elements */
    * {
        transition-property: color, background-color, border-color, transform, box-shadow;
        transition-duration: 300ms;
    }
</style>
</div>