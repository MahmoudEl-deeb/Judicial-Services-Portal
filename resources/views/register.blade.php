<x-layout>
    <x-slot:title>
        التسجيل
    </x-slot:title>

    <form method="POST" action="{{ route('registerProcess') }}">
        @csrf
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">الاسم الأول <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('first_name') is-invalid @enderror" 
                           id="first_name" 
                           name="first_name"
                           value="{{ old('first_name') }}"
                           placeholder="أدخل الاسم الأول" 
                           required>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">اسم العائلة <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('last_name') is-invalid @enderror" 
                           id="last_name" 
                           name="last_name"
                           value="{{ old('last_name') }}"
                           placeholder="أدخل اسم العائلة" 
                           required>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email">البريد الإلكتروني <span class="text-danger">*</span></label>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="أدخل البريد الإلكتروني" 
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="national_id">الرقم القومي <span class="text-danger">*</span></label>
            <input type="text" 
                   class="form-control @error('national_id') is-invalid @enderror" 
                   id="national_id" 
                   name="national_id"
                   value="{{ old('national_id') }}"
                   placeholder="أدخل الرقم القومي (14 رقم)" 
                   maxlength="14"
                   pattern="[0-9]{14}"
                   required>
            <small class="form-text text-muted">يجب أن يكون الرقم القومي مكون من 14 رقم</small>
            @error('national_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">رقم الهاتف</label>
            <input type="tel" 
                   class="form-control @error('phone') is-invalid @enderror" 
                   id="phone" 
                   name="phone"
                   value="{{ old('phone') }}"
                   placeholder="أدخل رقم الهاتف (اختياري)">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">كلمة المرور <span class="text-danger">*</span></label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password"
                           placeholder="أدخل كلمة المرور" 
                           required>
                    <small class="form-text text-muted">يجب أن تكون كلمة المرور 8 أحرف على الأقل</small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                    <input type="password" 
                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" 
                           name="password_confirmation"
                           placeholder="أعد إدخال كلمة المرور" 
                           required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="user_type">نوع المستخدم <span class="text-danger">*</span></label>
            <select class="form-control @error('user_type') is-invalid @enderror" 
                    id="user_type" 
                    name="user_type" 
                    required>
                <option value="">اختر نوع المستخدم</option>
                <option value="lawyer" {{ old('user_type') == 'lawyer' ? 'selected' : '' }}>محامي</option>
                <option value="litigant" {{ old('user_type') == 'litigant' ? 'selected' : '' }}>متقاضي</option>
            </select>
            @error('user_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lawyer-specific fields (shown conditionally) -->
        <div id="lawyer-fields" style="display: none;">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">بيانات المحامي</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bar_registration_number">رقم القيد بنقابة المحامين</label>
                                <input type="text" 
                                       class="form-control @error('bar_registration_number') is-invalid @enderror" 
                                       id="bar_registration_number" 
                                       name="bar_registration_number"
                                       value="{{ old('bar_registration_number') }}"
                                       placeholder="أدخل رقم القيد بالنقابة">
                                @error('bar_registration_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="specialization">التخصص</label>
                                <select class="form-control @error('specialization') is-invalid @enderror" 
                                        id="specialization" 
                                        name="specialization">
                                    <option value="">اختر التخصص</option>
                                    <option value="القانون المدني" {{ old('specialization') == 'القانون المدني' ? 'selected' : '' }}>القانون المدني</option>
                                    <option value="القانون الجنائي" {{ old('specialization') == 'القانون الجنائي' ? 'selected' : '' }}>القانون الجنائي</option>
                                    <option value="القانون التجاري" {{ old('specialization') == 'القانون التجاري' ? 'selected' : '' }}>القانون التجاري</option>
                                    <option value="القانون الإداري" {{ old('specialization') == 'القانون الإداري' ? 'selected' : '' }}>القانون الإداري</option>
                                    <option value="القانون الدستوري" {{ old('specialization') == 'القانون الدستوري' ? 'selected' : '' }}>القانون الدستوري</option>
                                    <option value="قانون العمل" {{ old('specialization') == 'قانون العمل' ? 'selected' : '' }}>قانون العمل</option>
                                    <option value="قانون الأحوال الشخصية" {{ old('specialization') == 'قانون الأحوال الشخصية' ? 'selected' : '' }}>قانون الأحوال الشخصية</option>
                                    <option value="القانون الضريبي" {{ old('specialization') == 'القانون الضريبي' ? 'selected' : '' }}>القانون الضريبي</option>
                                </select>
                                @error('specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="bar_registration_image">صورة شهادة القيد بنقابة المحامين</label>
                        <input type="file" 
                               class="form-control-file @error('bar_registration_image') is-invalid @enderror" 
                               id="bar_registration_image" 
                               name="bar_registration_image"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small class="form-text text-muted">يُقبل ملفات PDF أو صور (JPG, PNG) - الحد الأقصى 5MB</small>
                        @error('bar_registration_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="registration_date">تاريخ القيد بالنقابة</label>
                        <input type="date" 
                               class="form-control @error('registration_date') is-invalid @enderror" 
                               id="registration_date" 
                               name="registration_date"
                               value="{{ old('registration_date') }}">
                        @error('registration_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" 
                   class="form-check-input @error('terms') is-invalid @enderror" 
                   id="terms" 
                   name="terms" 
                   value="1" 
                   required>
            <label class="form-check-label" for="terms">
                أوافق على <a href="#" target="_blank">الشروط والأحكام</a> و <a href="#" target="_blank">سياسة الخصوصية</a> <span class="text-danger">*</span>
            </label>
            @error('terms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">إنشاء حساب جديد</button>
        </div>

        <div class="text-center">
            <p class="mb-0">لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </form>

    <script>
        // Show/hide lawyer fields based on user type selection
        document.getElementById('user_type').addEventListener('change', function() {
            const lawyerFields = document.getElementById('lawyer-fields');
            const barRegistrationNumber = document.getElementById('bar_registration_number');
            const specialization = document.getElementById('specialization');
            const barRegistrationImage = document.getElementById('bar_registration_image');
            
            if (this.value === 'lawyer') {
                lawyerFields.style.display = 'block';
                barRegistrationNumber.required = true;
                specialization.required = true;
                barRegistrationImage.required = true;
            } else {
                lawyerFields.style.display = 'none';
                barRegistrationNumber.required = false;
                specialization.required = false;
                barRegistrationImage.required = false;
            }
        });

        // Trigger change event on page load to show fields if lawyer was previously selected
        document.addEventListener('DOMContentLoaded', function() {
            const userTypeSelect = document.getElementById('user_type');
            if (userTypeSelect.value === 'lawyer') {
                userTypeSelect.dispatchEvent(new Event('change'));
            }
        });

        // National ID validation
        document.getElementById('national_id').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function() {
            let value = this.value.replace(/[^0-9+]/g, '');
            if (value && !value.startsWith('+2') && !value.startsWith('01')) {
                if (value.startsWith('1')) {
                    value = '0' + value;
                }
            }
            this.value = value;
        });

        // Password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (password !== confirmation) {
                this.setCustomValidity('كلمات المرور غير متطابقة');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>

    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .invalid-feedback {
            display: block;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
        
        .card {
            border-radius: 0.5rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
        }
        
        .form-check-label a {
            color: #007bff;
            text-decoration: none;
        }
        
        .form-check-label a:hover {
            text-decoration: underline;
        }
        
        /* RTL support */
        body[dir="rtl"] .form-check {
            text-align: right;
        }
        
        body[dir="rtl"] .form-check-input {
            margin-left: 0.25rem;
            margin-right: -1.25rem;
        }
    </style>
</x-layout>