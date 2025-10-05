<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="{ sidebarOpen: false, userMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - {{ config('app.name', 'محكمة النقض المصرية') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --gold-primary: #D4AF37;
            --gold-secondary: #B8941F;
            --gold-light: #F7EFD8;
            --gold-dark: #9C7C1A;
            --grey-dark: #2D3748;
            --grey-medium: #4A5568;
            --grey-light: #718096;
            --grey-bg: #F8FAFC;
            --white: #FFFFFF;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--grey-bg);
        }
        
        .gold-gradient {
            background: linear-gradient(135deg, var(--gold-primary) 0%, var(--gold-secondary) 100%);
        }
        
        .gold-text {
            color: var(--gold-primary);
        }
        
        .gold-bg {
            background-color: var(--gold-primary);
        }
        
        .gold-border {
            border-color: var(--gold-primary);
        }
        
        .grey-dark-bg {
            background-color: var(--grey-dark);
        }
        
        .grey-dark-text {
            color: var(--grey-dark);
        }
        
        .grey-medium-text {
            color: var(--grey-medium);
        }
        
        .grey-light-text {
            color: var(--grey-light);
        }
        
        .gold-light-bg {
            background-color: var(--gold-light);
        }
        
        .sidebar-bg {
            background: linear-gradient(180deg, var(--grey-dark) 0%, #1A202C 100%);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
            border-right: 3px solid transparent;
        }
        
        .nav-link:hover {
            background-color: rgba(212, 175, 55, 0.1);
            border-right-color: var(--gold-primary);
        }
        
        .nav-link.active {
            background-color: rgba(212, 175, 55, 0.15);
            border-right-color: var(--gold-primary);
        }
        
        .sidebar-overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .transition-all-300 {
            transition: all 0.3s ease;
        }
        
        .shadow-custom {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .user-avatar {
            background: linear-gradient(135deg, var(--gold-primary) 0%, var(--gold-secondary) 100%);
        }
    </style>
</head>

<body class="bg-[#F8FAFC]">
    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden sidebar-overlay transition-opacity duration-300"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <!-- Navbar -->
    <header class="bg-white shadow-custom sticky top-0 z-20 border-b gold-border z-50">
        <div class="flex justify-between items-center px-6 py-3">
            <!-- Logo and Title -->
            <div class="flex items-center space-x-4 space-x-reverse">
                <div class="w-14 h-14 rounded-full overflow-hidden border-2 gold-border shadow-md">
                    <img src="{{ asset('storage/landing-page/unnamed.webp') }}" 
                         alt="شعار محكمة النقض المصرية" class="h-full w-full object-cover">
                </div>
                <div class="border-r-2 border-gray-200 pr-4">
                    <h1 class="text-xl font-bold grey-dark-text">محكمة النقض المصرية</h1>
                    <p class="text-xs grey-light-text">نظام الخدمات القضائية الإلكترونية</p>
                </div>
            </div>

            <div class="flex items-center space-x-4 space-x-reverse">
                <!-- Sidebar Toggle -->
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="md:hidden p-2 rounded-lg bg-gold-light gold-text transition-all-300 hover:bg-gold-primary hover:text-white">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                
                <!-- Dashboard Title -->
                <div class="text-center hidden sm:block">
                    <h1 class="text-lg font-bold gold-text">لوحة التحكم</h1>
                    <p class="text-xs grey-light-text">مرحباً بك في النظام الإلكتروني</p>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="relative" x-data="{ userMenuOpen: false }">
                <button @click="userMenuOpen = !userMenuOpen" 
                        class="flex items-center space-x-3 space-x-reverse focus:outline-none bg-gold-light px-4 py-2 rounded-lg gold-text font-medium transition-all-300 hover:bg-gold-primary hover:text-white">
                    <!-- User Avatar -->
                    <div class="w-8 h-8 user-avatar rounded-full flex items-center justify-center text-white text-sm font-bold">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                    <div class="text-right hidden md:block">
                        <span class="block text-sm font-medium">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        <span class="block text-xs grey-light-text">{{ Auth::user()->email }}</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300" 
                       :class="userMenuOpen ? 'rotate-180' : ''"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-lg py-2 z-50 border gold-border">
                     
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3 space-x-reverse">
                            <div class="w-12 h-12 user-avatar rounded-full flex items-center justify-center text-white text-lg font-bold">
                                {{ substr(Auth::user()->first_name, 0, 1) }}
                            </div>
                            <div class="flex-1 text-right">
                                <p class="text-sm font-bold grey-dark-text">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                <p class="text-xs grey-light-text truncate">{{ Auth::user()->email }}</p>
                                <p class="text-xs gold-text mt-1">
                                    @if(Auth::user()->role === 'lawyer')
                                        <i class="fas fa-user-tie ml-1"></i> محامي
                                    @else
                                        <i class="fas fa-user ml-1"></i> مستخدم
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Menu Items -->
                    <a href="{{ route('profile.show') }}" 
                       class="flex items-center px-4 py-3 text-sm grey-medium-text hover:bg-gold-light transition-colors">
                        <i class="fas fa-user-circle ml-3 gold-text"></i>
                        <span>الملف الشخصي</span>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center px-4 py-3 text-sm grey-medium-text hover:bg-gold-light transition-colors">
                        <i class="fas fa-cog ml-3 gold-text"></i>
                        <span>الإعدادات</span>
                    </a>
                    
                    <a href="3" 
                       class="flex items-center px-4 py-3 text-sm grey-medium-text hover:bg-gold-light transition-colors">
                        <i class="fas fa-bell ml-3 gold-text"></i>
                        <span>الإشعارات</span>
                        <span class="mr-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                    </a>
                    
                    <div class="border-t border-gray-100 my-1"></div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full text-right flex items-center px-4 py-3 text-sm grey-medium-text hover:bg-gold-light transition-colors">
                            <i class="fas fa-sign-out-alt ml-3 gold-text"></i>
                            <span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed md:static inset-y-0 right-0 w-72 flex-shrink-0 sidebar-bg text-white transform md:translate-x-0 transition-transform duration-300 ease-in-out z-40 min-h-screen shadow-custom">
            
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-[#4A5568]">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold gold-text">القائمة الرئيسية</h2>
                    <button @click="sidebarOpen = false" class="md:hidden p-1 rounded hover:bg-[#4A5568] transition-all-300">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <!-- Quick Stats -->
                <div class="bg-[#2D3748] rounded-lg p-4 border border-[#4A5568]">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-300">الحالة</span>
                        <span class="text-xs bg-green-500 text-white px-2 py-1 rounded-full">نشط</span>
                    </div>
                    <div class="text-xs text-gray-400">
                        آخر دخول: {{ \Carbon\Carbon::now()->subHours(2)->diffForHumans() }}
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="p-4 overflow-y-auto" style="max-height: calc(100vh - 200px)">
                <nav class="space-y-1">
                    @foreach($links as $link)
                        <a href="{{ $link['url'] }}" 
                           class="nav-link flex items-center px-4 py-3 rounded-lg transition-all-300 group"
                           :class="{ 'active': window.location.pathname === '{{ $link['url'] }}' }">
                            <div class="w-10 h-10 rounded-lg bg-[#4A5568] flex items-center justify-center transition-all-300 group-hover:bg-gold-primary group-[.active]:bg-gold-primary">
                                <i class="{{ $link['icon'] ?? 'fas fa-circle' }} text-sm group-hover:text-white group-[.active]:text-white"></i>
                            </div>
                            <span class="mr-3 font-medium transition-all-300 group-hover:text-gold-primary group-[.active]:text-gold-primary">
                                {{ $link['label'] }}
                            </span>
                            
                            @if(isset($link['badge']))
                                <span class="mr-auto bg-gold-primary text-white text-xs px-2 py-1 rounded-full">
                                    {{ $link['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </nav>
                
                <!-- Sidebar Footer -->
                <div class="mt-8 pt-6 border-t border-[#4A5568]">
                    <div class="px-4">
                        <div class="bg-[#2D3748] rounded-lg p-4 text-center">
                            <div class="w-12 h-12 mx-auto mb-3 bg-gold-primary rounded-full flex items-center justify-center">
                                <i class="fas fa-headset text-white text-lg"></i>
                            </div>
                            <h4 class="text-sm font-bold text-white mb-1">الدعم الفني</h4>
                            <p class="text-xs text-gray-400 mb-3">نسعد بمساعدتك على مدار الساعة</p>
                            <a href="tel:19991" class="block w-full bg-gold-primary text-white py-2 rounded-lg text-sm font-bold hover:bg-gold-secondary transition-all-300">
                                <i class="fas fa-phone ml-1"></i>
                                19991
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 transition-all duration-300">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 space-x-reverse">
                        <li>
                            <a href="/dashboard" class="text-gold-primary hover:text-gold-secondary transition-colors">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-chevron-left text-gray-400 text-xs mx-2"></i>
                            <span class="text-sm grey-medium-text">لوحة التحكم</span>
                        </li>
                        @if(isset($breadcrumb))
                            @foreach($breadcrumb as $item)
                                <li class="flex items-center">
                                    <i class="fas fa-chevron-left text-gray-400 text-xs mx-2"></i>
                                    <span class="text-sm grey-medium-text">{{ $item }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ol>
                </nav>
            </div>

            <!-- Page Content -->
            <div class="bg-white rounded-2xl shadow-custom border border-gray-100 min-h-[calc(100vh-200px)]">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <footer class="mt-8 text-center">
                <p class="text-sm grey-light-text">
                    &copy; {{ date('Y') }} محكمة النقض المصرية. جميع الحقوق محفوظة.
                </p>
                <p class="text-xs grey-light-text mt-1">
                    الإصدار 2.1.0 | آخر تحديث: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </p>
            </footer>
        </main>
    </div>

    <script>
        // Auto-close mobile sidebar when clicking on a link
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        Alpine.store('sidebarOpen', false);
                    }
                });
            });
        });
    </script>
</body>
</html>