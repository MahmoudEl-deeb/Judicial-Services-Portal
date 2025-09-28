<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <i class="fas fa-sign-in-alt text-2xl text-blue-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">تسجيل الدخول</h1>
            <p class="text-gray-600">مرحباً بعودتك!</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Display validation errors -->
        @error('email')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-red-400 ml-2 mt-1"></i>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">خطأ في تسجيل الدخول</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @enderror

        <form wire:submit.prevent="login" class="space-y-6">

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    البريد الإلكتروني <span class="text-red-500">*</span>
                </label>
                <input id="email" 
                       wire:model="email" 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="example@email.com"
                       autofocus 
                       autocomplete="email">
                @error('email') 
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    كلمة المرور <span class="text-red-500">*</span>
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <input id="password" 
                           :type="showPassword ? 'text' : 'password'" 
                           wire:model="password" 
                           class="mt-1 block w-full px-3 py-2 pl-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           placeholder="أدخل كلمة المرور"
                           autocomplete="current-password">
                    <button type="button" 
                            @click="showPassword = !showPassword"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
                @error('password') 
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle ml-1"></i>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" wire:model.defer="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        تذكرني
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-500 transition-colors duration-200" href="{{ route('password.request') }}">
                        هل نسيت كلمة المرور؟
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6">
                <a class="text-sm text-blue-600 hover:text-blue-500 transition-colors duration-200" href="{{ route('register') }}" wire:navigate>
                    ليس لديك حساب؟
                </a>

                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                    <span wire:loading.remove>
                        <i class="fas fa-sign-in-alt ml-2"></i>
                        تسجيل الدخول
                    </span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin ml-2"></i>
                        جاري الدخول...
                    </span>
                </button>
            </div>

        </form>
    </div>
</div>
