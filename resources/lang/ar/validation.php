<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute ليس رابطًا صحيحًا.',
    'after'                => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal'       => 'يجب أن يكون :attribute تاريخًا مساويًا أو بعد :date.',
    'alpha'                => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash'           => 'يجب أن يحتوي :attribute على أحرف، أرقام، شرطات أو شرطات سفلية فقط.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array'                => 'يجب أن يكون :attribute مصفوفة.',
    'before'               => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal'      => 'يجب أن يكون :attribute تاريخًا مساويًا أو قبل :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون طول :attribute بين :min و :max حروف.',
        'array'   => 'يجب أن يحتوي :attribute بين :min و :max عناصر.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما صح أو خطأ.',
    'confirmed'            => 'تأكيد :attribute غير متطابق.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute تاريخًا مساويًا لـ :date.',
    'date_format'          => 'لا يطابق :attribute الصيغة :format.',
    'different'            => 'يجب أن يكون :attribute مختلفًا عن :other.',
    'digits'               => 'يجب أن يحتوي :attribute على :digits أرقام.',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max أرقام.',
    'email'                => 'يجب أن يكون :attribute بريدًا إلكترونيًا صحيحًا.',
    'exists'               => ':attribute المحدد غير صحيح.',
    'file'                 => 'يجب أن يكون :attribute ملفًا.',
    'filled'               => 'يجب ملء :attribute.',
    'image'                => 'يجب أن يكون :attribute صورة.',
    'in'                   => ':attribute المحدد غير صحيح.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'max'                  => [
        'numeric' => 'يجب ألا تزيد قيمة :attribute عن :max.',
        'file'    => 'يجب ألا يزيد حجم :attribute عن :max كيلوبايت.',
        'string'  => 'يجب ألا يزيد طول :attribute عن :max حروف.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :max عناصر.',
    ],
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون حجم :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول :attribute على الأقل :min حروف.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل :min عناصر.',
    ],
    'not_in'               => ':attribute المحدد غير صحيح.',
    'numeric'              => 'يجب أن يكون :attribute رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'regex'                => 'صيغة :attribute غير صحيحة.',
    'required'             => 'حقل :attribute مطلوب.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'unique'               => ':attribute مُستخدم بالفعل.',
    'url'                  => 'صيغة :attribute غير صحيحة.',

    

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    | هنا نغير أسماء الحقول بدل ما يطلع "email" يطلع "البريد الإلكتروني"
    */
    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
    ],

];
