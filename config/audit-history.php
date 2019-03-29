<?php

return [
    'user' => [
        'name_attribute' => 'full_name_shorten',
        // Spatie permission master role
        'master_role_name' => 'system',
        'routes' => [
            'show' => 'admin.auth.user.show',
        ],
    ],

    'formats' => [
//        'date' => 'F jS, Y',
//        'time_12' => 'g:ia',
//        'time_24' => 'g:i',
        'datetime_12' => 'F jS, Y g:ia',
//        'datetime_24' => 'F jS, Y g:i',
    ],
];
