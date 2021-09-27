<?php

return [
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    'cookie_name' => 'cookie_consent',

    'cookie_lifetime_in_minutes' => 30 * 13 * 24 * 60,

    'cookie_categories' => [
        'system' => [
            'required' => true,
        ],
    ],
    
    'has_manage_modal' => true,

    'middleware' => null,

    'page_url' => '/cookies',
    
    'xhr' => false,
    
    'xhr_script_file' => '/js/cookies.js',
    
];
