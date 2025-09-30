<div>
<div x-data="{ showImageModal: false }">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">تفاصيل المستخدم</h1>

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-bold mb-4">المعلومات الأساسية</h2>
                    <p class="mb-2"><strong>الاسم:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                    <p class="mb-2"><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
                    <p class="mb-2"><strong>الرقم القومي:</strong> {{ $user->national_id }}</p>
                    <p class="mb-2"><strong>الهاتف:</strong> {{ $user->phone ?? 'غير متوفر' }}</p>
                    <p class="mb-2">
                        <strong>العنوان:</strong> 
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
                
                <div>
                    <h2 class="text-xl font-bold mb-4">معلومات النظام</h2>
                    <p class="mb-2">
                        <strong>الدور:</strong> 
                        @if($user->roles->first())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $user->roles->first()->name }}
                            </span>
                        @else
                            غير محدد
                        @endif
                    </p>
                    <p class="mb-2">
                        <strong>الحالة:</strong> 
                        @php
                            $statusClasses = [
                                'active' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'suspended' => 'bg-red-100 text-red-800',
                                'inactive' => 'bg-gray-100 text-gray-800'
                            ];
                            $statusClass = $statusClasses[$user->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </p>
                    <p class="mb-2"><strong>تاريخ التسجيل:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
                    <p class="mb-2">
                        <strong>البريد مفعل:</strong> 
                        @if($user->email_verified_at)
                            <span class="text-green-600">✓ نعم</span>
                        @else
                            <span class="text-red-600">✗ لا</span>
                        @endif
                    </p>

                    @if ($user->lawyer)
                        <h2 class="text-xl font-bold mt-6 mb-2">معلومات المحامي</h2>
                        <p class="mb-2"><strong>رقم التسجيل في النقابة:</strong> {{ $user->lawyer->bar_registration_number }}</p>
                        <p class="mb-2"><strong>التخصص:</strong> {{ $user->lawyer->specialization }}</p>
                        <p class="mb-2">
                            <strong>صورة بطاقة النقابة:</strong> 
                            <button @click="showImageModal = true" 
                                    class="text-blue-500 hover:text-blue-700 underline cursor-pointer">
                                عرض الصورة
                            </button>
                        </p>
                    @endif
                </div>
            </div>

            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-4">تحديث حالة المستخدم</h2>
                <div class="flex items-center gap-4">
                    <select wire:model="status" 
                            class="form-select block w-full md:w-64 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button wire:click="updateUserStatus" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-200">
                        تحديث
                    </button>
                </div>
            </div>

            <div class="mt-6 border-t pt-6">
                <a href="{{ route('admin.users') }}" wire:navigate
                   class="inline-flex items-center text-blue-500 hover:text-blue-700">
                    ← العودة لقائمة المستخدمين
                </a>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    @if ($user->lawyer)
        <div x-show="showImageModal" 
             x-cloak
             @click.away="showImageModal = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4">
            <div class="relative max-w-4xl max-h-screen bg-white rounded-lg shadow-xl overflow-hidden">
                <!-- Close Button -->
                <button @click="showImageModal = false" 
                        class="absolute top-4 left-4 z-10 bg-white rounded-full p-2 hover:bg-gray-100 transition shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Image -->
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-4 text-center">صورة بطاقة النقابة</h3>
                    <img src="{{ asset('storage/' . $user->lawyer->bar_registration_image) }}" 
                         alt="Bar Registration Image"
                         class="max-w-full max-h-[80vh] mx-auto object-contain rounded">
                    
                    <!-- Download Button -->
                    <div class="mt-4 text-center">
                        <a href="{{ asset('storage/' . $user->lawyer->bar_registration_image) }}" wire:navigate
                           download
                           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                            تحميل الصورة
                        </a>
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