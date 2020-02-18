<?php

namespace Code16\CookieConsent;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\EncryptCookies;
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

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cookieConsent');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cookieConsent');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->app->resolving(EncryptCookies::class, function (EncryptCookies $encryptCookies) {
            $encryptCookies->disableFor(config('cookie-consent.cookie_name'));
        });

        $this->app['view']->composer('cookieConsent::index', function (View $view) {
            $alreadyConsentedWithCookies = Cookie::has(config('cookie-consent.cookie_name'));

            $categories = collect(config('cookie-consent.cookie_categories'))
                ->map(function ($category, $categoryKey) {
                    $texts = trans("cookieConsent::texts.manage.categories.{$categoryKey}");
                    return array_merge($category, [
                        "value" => (new CookieConsent())->getValueFor($categoryKey, true),
                        "title" => $texts['title'],
                        "description" => $texts['description'],
                        "key" => $categoryKey,
                    ]);
                });

            $hasManage = $categories->some(function ($category) {
                $isRequired = $category['required'] ?? false;
                return !$isRequired;
            });

            $view->with(compact('alreadyConsentedWithCookies', 'categories', 'hasManage'));
        });

        Blade::if('cookies', function ($categoryKey) {
            return (new CookieConsent())->getValueFor($categoryKey, false);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cookie-consent.php', 'cookie-consent');
    }
}