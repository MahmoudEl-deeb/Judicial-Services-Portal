<div>
    <h1 class="text-2xl font-bold mb-6">لوحة تحكم المحامي</h1>
    <p class="mb-8 text-gray-600">مرحباً بعودتك، {{ $user->first_name }}! إليك معلومات ملفك الشخصي.</p>

    <!-- Profile Information -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">معلومات الملف الشخصي</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-semibold text-gray-700">الاسم الكامل</p>
                <p class="text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">البريد الإلكتروني</p>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">رقم الهاتف</p>
                <p class="text-gray-900">{{ $user->phone }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">الرقم القومي</p>
                <p class="text-gray-900">{{ $user->national_id }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="font-semibold text-gray-700">العنوان</p>
                <p class="text-gray-900">{{ $user->address }}, {{ $user->city }}, {{ $user->governorate }}</p>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ route('profile.show') }}" class="text-blue-600 hover:underline">تعديل الملف الشخصي</a>
        </div>
    </div>
</div>
