<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.guest')] class extends Component
{
    use WithFileUploads;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $national_id = '';
    public string $phone_number = '';
    public string $role = '';
    public string $password = '';
    public string $password_confirmation = '';

    // حقول إضافية للمحامي
    public string $bar_registration_number = '';
    public $bar_registration_image; // صور لازم تبقى متغير عام مش string
    public string $specialization = '';

    public function register(): void
    {
        // التحقق الأساسي للجميع
        $validated = $this->validate([
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'national_id'  => ['required', 'string', 'max:14', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'regex:/^(010|011|012|015)[0-9]{8}$/', 'unique:' . User::class],
            'role'         => ['required', 'in:lawyer,litigant'],
            'password'     => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // شروط إضافية لو المستخدم محامي
        if ($validated['role'] === 'lawyer') {
            $extra = $this->validate([
                'bar_registration_number' => ['required', 'string', 'max:50', 'unique:' . User::class],
                'bar_registration_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'specialization'          => ['required', 'string', 'max:255'],
            ]);

            // رفع صورة الكارنيه وتخزينها
            $extra['bar_registration_image'] = $this->bar_registration_image->store('bar_images', 'public');

            // دمج البيانات
            $validated = array_merge($validated, $extra);
        }

        // تشفير الباسورد
        $validated['password'] = Hash::make($validated['password']);

        // إنشاء المستخدم
        event(new Registered($user = User::create($validated)));

        // تسجيل الدخول مباشرة
        Auth::login($user);

        // إعادة التوجيه للداشبورد
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div>
    <x-slot:title>إنشاء حساب جديد</x-slot>

    <form wire:submit="register" enctype="multipart/form-data">
        <!-- الاسم الأول -->
        <div>
            <x-input-label for="first_name" value="الاسم الأول" />
            <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" required autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- اسم العائلة -->
        <div class="mt-4">
            <x-input-label for="last_name" value="اسم العائلة" />
            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- البريد الإلكتروني -->
        <div class="mt-4">
            <x-input-label for="email" value="البريد الإلكتروني" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full"  />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- الرقم القومي -->
        <div class="mt-4">
            <x-input-label for="national_id" value="الرقم القومي" />
            <x-text-input wire:model="national_id" id="national_id" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('national_id')" class="mt-2" />
        </div>

        <!-- رقم الهاتف -->
        <div class="mt-4">
            <x-input-label for="phone_number" value="رقم الهاتف" />
            <x-text-input wire:model="phone_number" id="phone_number" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- الدور -->
        <div class="mt-4">
            <x-input-label for="role" value="نوع الحساب" />
            <select wire:model="role" id="role" class="block mt-1 w-full border-gray-300 rounded">
                <option value="">اختر النوع</option>
                <option value="lawyer">محامي</option>
                <option value="litigant">متقاضي</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- حقول المحامي -->
        @if($role === 'lawyer')
            <!-- رقم القيد -->
            <div class="mt-4">
                <x-input-label for="bar_registration_number" value="رقم القيد بنقابة المحامين" />
                <x-text-input wire:model="bar_registration_number" id="bar_registration_number" class="block mt-1 w-full" type="text" required />
                <x-input-error :messages="$errors->get('bar_registration_number')" class="mt-2" />
            </div>

            <!-- صورة الكارنيه -->
            <div class="mt-4">
                <x-input-label for="bar_registration_image" value="صورة كارنيه النقابة" />
                <input wire:model="bar_registration_image" id="bar_registration_image" type="file" class="block mt-1 w-full" required />
                <x-input-error :messages="$errors->get('bar_registration_image')" class="mt-2" />
            </div>

            <!-- التخصص -->
            <div class="mt-4">
                <x-input-label for="specialization" value="التخصص" />
                <x-text-input wire:model="specialization" id="specialization" class="block mt-1 w-full" type="text" required />
                <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
            </div>
        @endif

        <!-- كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password" value="كلمة المرور" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                          type="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="تأكيد كلمة المرور" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                          type="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- الأزرار -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}" wire:navigate>
                لديك حساب بالفعل؟
            </a>

            <x-primary-button class="ms-4">
                إنشاء حساب
            </x-primary-button>
        </div>
    </form>
</div>
