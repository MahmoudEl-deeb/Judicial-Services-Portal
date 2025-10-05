<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#F8FAFC] py-8">
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-custom border border-gray-100">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 gold-bg rounded-full mb-4 shadow-lg">
                    <i class="fas fa-envelope-open-text text-2xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold grey-dark-text mb-4">تأكيد البريد الإلكتروني</h1>
            </div>

            <!-- Instruction Text -->
            <div class="mb-6 text-sm grey-medium-text leading-relaxed text-right">
                قبل المتابعة، يرجى تأكيد عنوان بريدك الإلكتروني بالنقر على الرابط الذي أرسلناه إليك للتو. إذا لم تستلم البريد الإلكتروني، سنرسل لك رسالة أخرى بكل سرور.
            </div>

            <!-- Success Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-400 ml-2"></i>
                        <span class="text-green-700 text-sm font-medium">
                            تم إرسال رابط تحقق جديد إلى عنوان البريد الإلكتروني الذي قدمته في إعدادات ملفك الشخصي.
                        </span>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="mt-6 space-y-4">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full gold-bg hover:bg-gold-secondary text-white py-3 px-4 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                        <i class="fas fa-paper-plane"></i>
                        إعادة إرسال بريد التأكيد
                    </button>
                </form>

                <!-- Additional Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.show') }}"
                           class="text-sm gold-text hover:text-gold-secondary font-medium transition-colors duration-300 flex items-center gap-2">
                            <i class="fas fa-user-edit"></i>
                            تعديل الملف الشخصي
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 flex items-center gap-2">
                                <i class="fas fa-sign-out-alt"></i>
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-gray-200 text-center">
                <p class="text-sm grey-medium-text mb-2">هل تحتاج مساعدة؟</p>
                <div class="flex flex-col sm:flex-row gap-2 justify-center text-xs">
                    <span class="text-gold-primary font-medium">
                        <i class="fas fa-envelope ml-1"></i>
                        support@cassation.gov.eg
                    </span>
                    <span class="hidden sm:block text-gray-400">|</span>
                    <span class="text-gold-primary font-medium">
                        <i class="fas fa-phone ml-1"></i>
                        16000
                    </span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .gold-bg {
            background-color: #D4AF37;
        }
        .gold-text {
            color: #D4AF37;
        }
        .gold-border {
            border-color: #D4AF37;
        }
        .gold-light-bg {
            background-color: #F7EFD8;
        }
        .grey-dark-text {
            color: #2D3748;
        }
        .grey-medium-text {
            color: #4A5568;
        }
        .grey-light-text {
            color: #718096;
        }
        .bg-gold-light {
            background-color: #F7EFD8;
        }
        .hover\:bg-gold-secondary:hover {
            background-color: #B8941F;
        }
        .hover\:text-gold-secondary:hover {
            color: #B8941F;
        }
        .shadow-custom {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</x-guest-layout>