<?php

return [
    'user' => [
        'guest' => [
            'prefix' => '',
            'middleware' => 'guestuser',
            'as' => 'user.',
        ],
        'auth' => [
            'prefix' => '',
            'middleware' => 'userauth',
            'as' => 'user.',
        ]
    ],
    'admin' => [
        'guest' => [
            'prefix' => 'admin', 
            'middleware' => 'guestadmin',
            'as' => 'admin.',
        ],
        'auth' => [
            'prefix' => 'admin', 
            'middleware' => 'adminauth',
            'as' => 'admin.',
        ]
    ]
];