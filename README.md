# Cookie consent

## Setup
```bash
composer require code16/cookie-consent
```

**Required**: publish assets
```php
php artisan vendor:publish --provider="Code16\CookieConsent\CookieConsentServiceProvider" --tag="assets"
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
    {{-- end of the body --}}
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

### Show the manage modal from a link (e.g. cookies page)
In the page:
```blade
    @section('content')
        <a href="#manage-cookies">Open manage cookies modal</a>
    @endsection
```

### Intercept accept POST request
If you need to add some custom logic when cookies are accepted (meaning: either when the used clicked on OK in the Bar or after setting his choices on the Modal), you can define a Middleware in the cookie-consent-middleware config key, which will be executed on the POST request.

Example:
```php
    // in config/cookie-consent.php
    return [
        // ...
        'middleware' => 'cookie-consent.accepted'
    ];
```
