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

    'page_url' => '/cookies',
];