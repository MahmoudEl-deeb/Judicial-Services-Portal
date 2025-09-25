
        <!-- Display general validation errors -->
        <x-validation-errors class="mb-4" />

        <form wire:submit.prevent="register" x-data="{ role: @entangle('role').live }" class="space-y-6">

            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label for="first_name" value="{{ __('الاسم الأول') }}" />
                    <x-input id="first_name" type="text" wire:model.live="first_name" class="mt-1 block w-full"  autofocus autocomplete="given-name" />
                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="last_name" value="{{ __('الاسم الأخير') }}" />
                    <x-input id="last_name" type="text" wire:model.live="last_name" class="mt-1 block w-full"  autocomplete="family-name" />
                    @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <x-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                <x-input id="email" type="email" wire:model.live="email" class="mt-1 block w-full"  autocomplete="email" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- National ID -->
            <div>
                <x-label for="national_id" value="{{ __('الرقم القومي') }}" />
                <x-input id="national_id" type="text" wire:model.live="national_id" class="mt-1 block w-full"  autocomplete="off" />
                @error('national_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <x-label for="phone" value="{{ __('رقم الهاتف') }}" />
                <x-input id="phone" type="text" wire:model.live="phone" class="mt-1 block w-full" autocomplete="tel" />
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address Info -->
            <div>
                <x-label for="address" value="{{ __('العنوان') }}" />
                <x-input id="address" type="text" wire:model.live="address" class="mt-1 block w-full" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-label for="city" value="{{ __('المدينة') }}" />
                    <x-input id="city" type="text" wire:model.live="city" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-label for="governorate" value="{{ __('المحافظة') }}" />
                    <x-input id="governorate" type="text" wire:model.live="governorate" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-label for="zipcode" value="{{ __('الرمز البريدي') }}" />
                    <x-input id="zipcode" type="text" wire:model.live="zipcode" class="mt-1 block w-full" />
                </div>
            </div>

            <!-- Role Selection -->
            <div>
                <x-label for="role" value="{{ __('الدور') }}" />
                <select id="role" wire:model.live="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="litigant">{{ __('متقاضي') }}</option>
                    <option value="lawyer">{{ __('محامي') }}</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Lawyer Extra Fields -->
            <div x-show="role === 'lawyer'" class="space-y-4 mt-4">
                <div>
                    <x-label for="bar_registration_number" value="{{ __('رقم القيد') }}" />
                    <x-input id="bar_registration_number" type="text" wire:model.live="bar_registration_number" class="mt-1 block w-full" />
                    @error('bar_registration_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="specialization" value="{{ __('التخصص') }}" />
                    <x-input id="specialization" type="text" wire:model.live="specialization" class="mt-1 block w-full" />
                    @error('specialization') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="password" value="{{ __('كلمة المرور') }}" />
                    <x-input id="password" type="password" wire:model.live="password" class="mt-1 block w-full"  autocomplete="new-password" />
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-label for="password_confirmation" value="{{ __('تأكيد كلمة المرور') }}" />
                    <x-input id="password_confirmation" type="password" wire:model.live="password_confirmation" class="mt-1 block w-full"  autocomplete="new-password" />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('لديك حساب بالفعل؟') }}
                </a>

                <x-button class="ml-4" wire:loading.attr="disabled">
                    {{ __('تسجيل') }}
                </x-button>
            </div>

        </form>

