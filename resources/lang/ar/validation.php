<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'phone' => [
            'digits_between' => 'رقم الهاتف يجب ان لا يتجاوز ال 15 رقم ولا يقل عن 8',
        ],
        'name' => [
            'required' => 'الاسم حقل الزامي',
            'string' => 'الاسم يجب ان يكون حروف',
            'max' => 'الاسم اطول من اللازن'
        ],
        'email' => [
            'required' => 'حقل البريد الالكتروني الزامي',
            'email' => 'برجاء ادخال بريد الكتروني صحيح',
            'max' => 'البريد الالكتروني اطول من الازم',
            'unique' => 'البريد الاكتروني مسجل مسبقا'
        ],
        'password' => [
            'required' => 'حقل كلمة المرور الزامي',
            'min' => 'كلمة المرور يجب ان لا تقل عن 6 حروف او ارقام',
            'confirmed' => 'كلمة المرور غير متوافقة مع التأكيد'
        ],
        'phone' => [
            'required' => 'الهاتف حقل الزامي',
            'digits_between' => 'الهاتف يجب ان يكون ارقام فقط و لا يتجاوز ال 15 رقم او يقل عن 8',
            'unique' => 'رقم الهاتف مسجل مسبقا'
        ],
        'language_id' => [
            'required' => 'حقل اللغة الزامي',
            'exists' => 'حقل اللغة الزامي',
            'numeric' => 'حقل اللغة الزامي'
        ],
        'country_id' => [
            'required' => 'حقل الدولة الزامي',
            'exists' => 'حقل الدولة الزامي',
            'numeric' => 'حقل الدولة الزامي'
        ],
        'address' => [
            'required' => 'حقل العنوان الزامي'
        ],
        'provider_member' => [
            'in' => 'قيمة خطأ لنوع التسجيل',
            'numeric' => 'قيمة خطأ لنوع التسجيل'
        ],
        'driver_member' => [
            'in' => 'قيمة خطأ لنوع التسجيل',
            'numeric' => 'قيمة خطأ لنوع التسجيل',
            'required_without' => 'اختر نوع التسجيل سائق او مورد'
        ],
        'user_id' => [
            'required' => 'رقم المستخدم حقل اساسي',
            'exists' => 'المستخدم غير موجود',
            'integer' => 'رقم المستخدم المدخل خطأ'
        ],
        'order_id' => [
            'required' => 'حقل الزامي',
            'integer' => 'رقم الطلب خطأ',
            'exists' => 'الطلب غير موجود او لا يمكن تعديلة',

        ],
        'client_name' => [
            'required' => 'حقل مطلوب',
            'max' => 'لا يزيد عن 190 حرف او رقم',

        ],
        'client_phone' => [
            'required' => 'حقل مطلوب',
            'digits_between' => 'يتكون من 8 - 15 خانات',
        ],

        'client_address' => [
            'required' => 'حقل مطلوب'
        ],
        'category_id' => [
            'required' => 'حقل الزامي',
            'integer' => 'قيمة خطأ',
            'exists' =>  'قيمة خطأ',
        ],
        'required_at' => [
            'required' => 'حقل الزامي',
            'date_format' => 'صيغة الوقت خطأ',
            'after' => 'ميعاد تسليم الطلب يجب ان يكون بعد تاريخ اليوم',
        ],
        'main_service_id' => [
            'required' => 'حقل الزامي',
            'integer' => 'قيمة خطأ',
            'exists' =>  'قيمة خطأ',
        ],
        'extra_service_id' => [
            'array' =>  'قيمة خطأ',
        ],

        'extra_service_id.*' => [
            'required' => 'حقل الزامي',
            'integer' => 'قيمة خطأ',
            'exists' =>  'قيمة خطأ',
        ],
        'payment_type_id' => [
            'required' => 'حقل الزامي',
            'integer' => 'قيمة خطأ',
            'exists' =>  'قيمة خطأ',
        ],
        'order_price' => [
            'required' => 'حقل الزامي',
            'numeric' => 'قيمة خطأ',
        ],
        'details' => [
            'required' => 'حقل الزامي',
            'string' => 'قيمة خطأ',
        ],
        'userName' => [
            'required' => 'حقل الزامي',
            'string' => 'قيمة خطأ',
            'max' => 'يجب انلا يتجاوز ال 190 حرف',
        ],
        'profileImage' => [
            'required' => 'حقل الزامي',
            'image' => 'الملف المرفق ليس صورة',
            'max' => 'حجم الصورة يجب ان لا يتجاوز ال 2 ميجابيت'
        ],
        'selected_order_id' => [
            'required' => 'رقم الطلب خطأ',
            'integer' => 'رقم الطلب خطأ',
            'exists' => 'لا يمكن تعديل هذا الطلب حاليا'
        ],
        'delivery_id' => [
            'required' => 'يجب اختيار موصل',
            'integer' => 'قيمة خطأ',
            'exists' => 'الموصل غير موجود'
        ],
        'languageAvailability' => [

            'integer' => 'قيمة خطأ',
            'in' => 'قيمة خطأ',

        ],
        'languageDefault' => [

            'integer' => 'قيمة خطأ',
            'in' => 'قيمة خطأ',
        ],
        'language_name' => [
            'required' => 'حقل الزامي',
            'unique' => 'اسم اللغة مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لاسم اللغة 190 حرف'
        ],
        'language_symbol' => [
            'required' => 'حقل الزامي',
            'unique' => 'رمز اللغة مستخدم مسبقا',
            'max' => 'اقصى عدد حروف متاح 2 حرف'
        ],
        'language_direction' => [
            'required' => 'اتجاه اللغة حقل مطلوب',
            'string' => 'قيمة خطأ في حقل اتجاه اللغة',
            'in' => 'قيمة خطأ في اتجاه اللغة'
        ],
        'status' => [
            'integer' => 'قيمة خطأ',
            'in' => 'قيمة خطأ',
            'required_if' => 'اختيارك يوجب اختيار الحاله متاح'
        ],
        'country_name' => [
            'required' => 'حقل الزامي',
            'unique' => 'اسم الدوله مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لاسم الدولة 190 حرف'
        ],
        'currency_name' => [
            'required' => 'حقل الزامي',
            'unique' => 'اسم عملة الدولة مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لاسم عملة الدولة 190 حرف'
        ],
        'currency_symbol' => [
            'required' => 'حقل الزامي',
            'unique' => 'رمز عملة الدولة مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لرمز عملة الدولة 190 حرف'
        ],
        'code' => [
            'required' => 'حقل الزامي',
            'numeric' => 'حقل الزامي',
            'unique' => 'مفتاح الدولة مسجل مسبقا'
        ],
        'time_zone' => [
            'required' => 'حقل الزامي',
            'timezone' => 'قيمة خطأ',
        ],
        'category_name' => [
            'required' => 'حقل الزامي',
            'unique' => 'اسم التصنيف مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لاسم التصنيف 190 حرف'
        ],
        'service_type_name' => [
            'required' => 'حقل الزامي',
            'unique' => 'اسم الخدمة مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لاسم الخدمة 190 حرف'
        ],
        'service_type_type' => [
            'integer' => 'قيمة خطأ',
            'in' => 'قيمة خطأ',
            'required' => 'حقل الزامي',
        ],
        'payment_type_name' => [
            'required' => 'حقل الزامي',
            'unique' => 'اسم طريقة الدفع مستخدم مسبقا',
            'max' => 'اقصى عدد حروف لاسم طريقة الدفع 190 حرف'
        ],
        'city_id' => [
            'integer' => 'قيمة خطأ',
            'in' => 'قيمة خطأ',
            'required' => 'حقل الزامي',
        ],
        'country_id' => [
            'integer' => 'قيمة خطأ',
            'in' => 'قيمة خطأ',
            'required' => 'حقل الزامي',
        ],
        'city_name' => [
            'required' => 'حقل الزامي',
            'max' => 'اسم المدينة يجب ان لا يتجاوز ال 190 حرف',
            'unique' => 'اسم المدينة مسجل مسبقا'
        ],
        'loading_id' => [
            'required' => 'قيمة خطأ',
            'integer' => 'قيمة خطأ',
            'exists' => 'قيمة خطأ'
        ],
        'min_time_deliver' => [
            'numeric' => 'قيمة خطأ لاقل وقت للتوصيل',
            'required' => 'حقل الزامي',
            'min' => 'اقل وقت للتوصل ساعة واحدة'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
