<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('storage/landing-page/unnamed.webp') }}" 
                         alt="Logo" class="h-16 w-auto">
                </a>
            </div>

            <!-- Links -->
            <div class="hidden md:flex space-x-8 text-lg">
                <a href="#" class="text-gray-700 hover:text-blue-600">أخبارنا</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">عن المحكمة</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">الخدمات</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">تلفي</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">الشكاوي</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">شيء آخر</a>
            </div>

            <!-- Auth Section -->
            <div class="relative" x-data="{ open: false }">
                @auth
                    <!-- Dropdown لو مسجل دخول -->
                    <button @click="open = ! open" 
                            class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none text-lg">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-md shadow-lg text-lg">
                        <a href="{{ route('profile.show') }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">الملف الشخصي</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-right px-4 py-2 text-gray-700 hover:bg-gray-100">
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                @endauth

                @guest
                    <!-- روابط لو مش مسجل -->
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-blue-600 text-lg mx-8">تسجيل الدخول</a>
                        <a href="{{ route('register') }}" 
                           class="text-gray-700 hover:text-blue-600 text-lg">إنشاء حساب</a>
                    </div>
                @endguest
            </div>

        </div>
    </div>
</nav>

