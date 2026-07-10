<?php

return [

    'mode' => 'utf-8',
    'format' => 'A4',

    'margin_left' => 0,
    'margin_right' => 0,
    'margin_top' => 0,
    'margin_bottom' => 0,

    'author' => '',
    'subject' => '',
    'keywords' => '',
    'creator' => 'Rayan Etfa',
    'display_mode' => 'fullpage',

    'tempDir' => storage_path('app/pdf-temp'),

    'font_path' => public_path('fonts'),

    'default_font' => 'iransans',

    'font_data' => [

        'primary_font' => [
            'R' => 'IRANSansWeb.ttf',
            'B' => 'IRANSansWeb_Bold.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],

    ],

];