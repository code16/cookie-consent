<?php

namespace Code16\CookieConsent;

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class CookieConsentServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/cookie-consent.php' => config_path('cookie-consent.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/cookieConsent'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('resources/lang/vendor/cookieConsent'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/../resources/assets/dist' => public_path('vendor/cookie-consent')
        ], 'assets');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cookieConsent');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cookieConsent');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->app->resolving(EncryptCookies::class, function (EncryptCookies $encryptCookies) {
            $encryptCookies->disableFor(config('cookie-consent.cookie_name'));
        });

        $this->app['view']->composer(['cookieConsent::index'], CookieConsentViewComposer::class);

        Blade::if('cookies', function ($categoryKey = null) {
            return $categoryKey
                ? (new CookieUtils())->getValueFor($categoryKey, 0)
                : Cookie::has(config('cookie-consent.cookie_name'));
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cookie-consent.php', 'cookie-consent');
    }
}