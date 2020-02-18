# Cookie consent

## Setup
```bash
composer require code16/cookie-consent
```

You may publish the config file:

```php
php artisan vendor:publish --provider="Code16\CookieConsent\CookieConsentServiceProvider" --tag="config"
```

And the lang file, if you need to update or add a translation (consider a PR in this case):

```php
php artisan vendor:publish --provider="Code16\CookieConsent\CookieConsentServiceProvider" --tag="lang"
```

## Usage
In your blade layout
```blade
<head>
    {{-- ... --}}
    @cookies('analytics')
        <script>
          {{-- some analytics script --}}
        </script>
    @endcookies
</head>

<body>
    {{-- ... --}}
    @include('cookieConsent::index')
</body>
```