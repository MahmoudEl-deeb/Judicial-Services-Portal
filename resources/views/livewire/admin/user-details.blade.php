<div>
<div x-data="{ showImageModal: false }">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold grey-dark-text mb-2">تفاصيل المستخدم</h1>
                    <p class="text-lg grey-medium-text">عرض وتعديل معلومات المستخدم في النظام</p>
                </div>
                <a href="{{ route('admin.users') }}" wire:navigate
                   class="inline-flex items-center gold-text hover:text-gold-secondary font-medium transition-colors">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة لقائمة المستخدمين
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session()->has('message'))
            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 mb-6" role="alert">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center ml-3">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <span class="text-green-700 font-medium">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6" role="alert">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center ml-3">
                        <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                    </div>
                    <span class="text-red-700 font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-custom border border-gray-100 overflow-hidden">
            <!-- User Header -->
            <div class="bg-gradient-to-r from-[#2D3748] to-[#4A5568] p-6 text-white">
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="w-20 h-20 user-avatar rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
                        <p class="text-gray-300">{{ $user->email }}</p>
                        <div class="flex items-center space-x-4 space-x-reverse mt-2">
                            @if($user->roles->first())
                                <span class="px-3 py-1 bg-gold-primary text-white text-sm rounded-full font-medium">
                                    {{ $user->roles->first()->name }}
                                </span>
                            @endif
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-500',
                                    'pending' => 'bg-yellow-500',
                                    'suspended' => 'bg-red-500',
                                    'inactive' => 'bg-gray-500'
                                ];
                                $statusColor = $statusColors[$user->status] ?? 'bg-gray-500';
                            @endphp
                            <span class="px-3 py-1 {{ $statusColor }} text-white text-sm rounded-full font-medium">
                                {{ ucfirst($user->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Details -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Basic Information -->
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 gold-bg rounded-lg flex items-center justify-center ml-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold grey-dark-text">المعلومات الأساسية</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">الاسم الكامل</span>
                                <span class="text-gray-700">{{ $user->first_name }} {{ $user->last_name }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">البريد الإلكتروني</span>
                                <span class="text-gray-700">{{ $user->email }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">الرقم القومي</span>
                                <span class="text-gray-700">{{ $user->national_id }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">رقم الهاتف</span>
                                <span class="text-gray-700">{{ $user->phone ?? 'غير متوفر' }}</span>
                            </div>
                            
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <div class="flex justify-between mb-2">
                                    <span class="font-medium grey-dark-text">العنوان</span>
                                </div>
                                <p class="text-gray-700 text-right">
                                    @if($user->address || $user->city || $user->governorate)
                                        {{ $user->address }}
                                        @if($user->city), {{ $user->city }}@endif
                                        @if($user->governorate), {{ $user->governorate }}@endif
                                        @if($user->zipcode), {{ $user->zipcode }}@endif
                                    @else
                                        غير متوفر
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center ml-3">
                                <i class="fas fa-cog text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold grey-dark-text">معلومات النظام</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">الدور</span>
                                @if($user->roles->first())
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full font-medium">
                                        {{ $user->roles->first()->name }}
                                    </span>
                                @else
                                    <span class="text-gray-500">غير محدد</span>
                                @endif
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">الحالة</span>
                                @php
                                    $statusClasses = [
                                        'active' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'suspended' => 'bg-red-100 text-red-800',
                                        'inactive' => 'bg-gray-100 text-gray-800'
                                    ];
                                    $statusClass = $statusClasses[$user->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 text-sm rounded-full font-medium {{ $statusClass }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">تاريخ التسجيل</span>
                                <span class="text-gray-700">{{ $user->created_at->format('Y-m-d') }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <span class="font-medium grey-dark-text">البريد مفعل</span>
                                @if($user->email_verified_at)
                                    <span class="flex items-center text-green-600">
                                        <i class="fas fa-check-circle ml-1"></i>
                                        نعم
                                    </span>
                                @else
                                    <span class="flex items-center text-red-600">
                                        <i class="fas fa-times-circle ml-1"></i>
                                        لا
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Lawyer Information -->
                        @if ($user->lawyer)
                            <div class="mt-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center ml-3">
                                        <i class="fas fa-user-tie text-white"></i>
                                    </div>
                                    <h3 class="text-xl font-bold grey-dark-text">معلومات المحامي</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                        <span class="font-medium grey-dark-text">رقم التسجيل في النقابة</span>
                                        <span class="text-gray-700">{{ $user->lawyer->bar_registration_number }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                        <span class="font-medium grey-dark-text">التخصص</span>
                                        <span class="text-gray-700">{{ $user->lawyer->specialization }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                        <span class="font-medium grey-dark-text">صورة بطاقة النقابة</span>
                                        <button @click="showImageModal = true" 
                                                class="gold-text hover:text-gold-secondary font-medium flex items-center transition-colors">
                                            <i class="fas fa-eye ml-2"></i>
                                            عرض الصورة
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Update Status Section -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center ml-3">
                            <i class="fas fa-sync-alt text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold grey-dark-text">تحديث حالة المستخدم</h3>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 bg-gold-light bg-opacity-30 p-6 rounded-2xl">
                        <select wire:model="status" 
                                class="flex-1 form-select block rounded-xl border border-gray-300 bg-white py-3 px-4 shadow-sm focus:border-gold-primary focus:ring-2 focus:ring-gold-primary transition-all duration-300">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button wire:click="updateUserStatus" 
                                class="gold-bg hover:bg-gold-secondary text-white font-bold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg flex items-center">
                            <i class="fas fa-save ml-2"></i>
                            تحديث الحالة
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    @if ($user->lawyer)
        <div x-show="showImageModal" 
             x-cloak
             @click.away="showImageModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4">
            <div class="relative max-w-4xl max-h-screen bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Close Button -->
                <button @click="showImageModal = false" 
                        class="absolute top-4 left-4 z-10 bg-white rounded-full p-3 hover:bg-gray-100 transition-all duration-300 shadow-lg">
                    <i class="fas fa-times text-gray-600"></i>
                </button>

                <!-- Image Content -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold grey-dark-text mb-6 text-center">صورة بطاقة النقابة</h3>
                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <img src="{{ asset('storage/' . $user->lawyer->bar_registration_image) }}" 
                             alt="Bar Registration Image"
                             class="max-w-full max-h-[60vh] mx-auto object-contain rounded-lg shadow-md">
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ asset('storage/' . $user->lawyer->bar_registration_image) }}" 
                           download
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-download ml-2"></i>
                            تحميل الصورة
                        </a>
                        <button @click="showImageModal = false"
                                class="border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-8 rounded-xl transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-times ml-2"></i>
                            إغلاق
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
</div>