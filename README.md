# Cookie consent

## Setup
```bash
composer require code16/cookie-consent
```

You may publish the config file:

```php
php artisan vendor:publish --provider="Code16\CookieConsent\CookieConsentServiceProvider" --tag="config"
```

And the lang file:

```php
php artisan vendor:publish --provider="Code16\CookieConsent\CookieConsentServiceProvider" --tag="lang"
```

## Usage

### Default
In your blade layout
```blade
<head>
    {{-- ... --}}

    @cookies
        <script>
          {{-- some injected cookies --}}
        </script>
    @endcookies
</head>

<body>
    {{-- ... --}}
    @include('cookieConsent::index')
</body>
```

### With category
To let the user manage multiple cookie categories (e.g. analytics, socials)
Add the category key to the `@cookies` directive
```blade
<head>
    {{-- ... --}}

    @cookies('analytics')
        <script>
          {{-- some analytics script --}}
        </script>
    @endcookies
</head>
```

Also you must declare the cookie category in `config/cookie-consent.php` as follow
```php
[
    'cookie_categories' => [
        'system' => [
            'required' => true,
        ],
        'analytics' => [],
    ]
];
```

Categories marked as `required` are cannot be opt-out by the user.

To provide explanation texts in the manage dialog, add content to the lang file:
```php
[
    'manage' => [
        'title' => 'Manage cookies',
        'description' => 'About cookies...',
        'categories' => [
            'system' => [
                'title' => 'System cookies',
                'description' => "Description text about system cookies",
            ],
            'analytics' => [
                'title' => 'Analytics cookies',
                'description' => "Description text about analytics cookies",
            ],
        ],
    ]
];
```