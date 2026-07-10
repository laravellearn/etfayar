<?php
return [
    'required' => ':attribute ضروری می باشد.',
    'required_if' => ':attribute ضروری می باشد در صورتی که :other :value باشد.',
    'unique' => ':attribute قبلا ثبت شده است',
    'not_regex' => 'فرمت :attribute نامعتبر می باشد.',
    'regex' => 'فرمت :attribute نامعتبر می باشد.',
    'confirmed' => ':attribute و تایید آن یکسان نیست',
    'max' => [
        'string' => ':attribute نباید بزرگتر :max کاراکتر باشد',
    ],
    'min' => [
        'string' => ':attribute باید بزرگتر از :min کاراکتر باشد',
    ],
    'size' => [
        'string' => ':attribute باید :size کاراکتر باشد.',
    ],

    'email' => 'فرمت :attribute باید صحیح باشد.',
    'attributes' => [
        'name' => 'نام',
        'family' => 'نام خانوادگی',
        'mobile' => 'تلفن همراه اصلی',
        'gender' => 'جنسیت',
        'company' => 'نام شرکت',
        'telephone' => 'تلفن',
        'email' => 'ایمیل',
        'customer_code' => 'کد مشتری',
        'roles' => 'نقش ها',
        'group_mobile.*' => 'تلفن همراه',
        'identity_type' => 'نوع هویت',
        'province_id' => 'استان',
        'city_id' => 'شهر',
        'username' => 'نام کاربری',
        'password' => 'رمز عبور',
        'password_confirm' => 'تایید رمز عبور',
        'longitude' => 'طول جغرافیایی',
        'latitude' => 'عرض جغرافیایی',
        'password_confirmation' => 'تایید رمز عبور',
        'service_id' => 'سرویس',
        'user_id' => 'کاربر',
        'description' => 'توضیحات',
        'code' => 'کد',
        'status' => 'وضعیت',
        'expert_id' => 'کارشناس',
        'natural' => 'حقیقی',
        'legal' => 'حقوقی',
    ],
    'value' => [
        'null' => 'خالی',
    ],
    'values' => [
        'identity_type' => [
            'legal' => 'حقوقی',
            'natural' => 'حقیقی',
        ], 'mobile' => [
            'null' => 'خالی',
        ], 'telephone' => [
            'null' => 'خالی',
        ],
    ],
];
