@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif

    <form wire:submit.prevent="login">

        @csrf

        <!-- البريد الإلكتروني -->
        <div>
            <x-label for="email" value="{{ __('البريد الإلكتروني') }}" />
            <x-input id="email" class="block mt-1 w-full" type="email" wire:model.defer="email" autofocus
                autocomplete="username" />
            @if ($errors->has('email'))
                <span class="text-sm text-red-600">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- كلمة المرور -->
        <div class="mt-4">
            <x-label for="password" value="{{ __('كلمة المرور') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" wire:model.defer="password"
                autocomplete="current-password" />

            @if ($errors->has('password'))
                <span class="text-sm text-red-600">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- تذكرني -->
        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-checkbox id="remember_me" wire:model.defer="remember" />
                <span class="ms-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
            </label>
        </div>

        <!-- الروابط وزر تسجيل الدخول -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('هل نسيت كلمة المرور؟') }}
                </a>
            @endif

            <x-button class="ms-4" wire:loading.attr="disabled">
                {{ __('تسجيل الدخول') }}
            </x-button>
        </div>
    </form>
