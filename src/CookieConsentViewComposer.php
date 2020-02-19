<?php

namespace Code16\CookieConsent;

use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class CookieConsentViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $alreadyConsentedWithCookies = Cookie::has(config('cookie-consent.cookie_name'));

        $categories = collect(config('cookie-consent.cookie_categories'))
            ->map(function ($category, $categoryKey) {
                $langKey = "cookieConsent::texts.manage.categories.{$categoryKey}";
                return array_merge($category, [
                    "title" => trans("{$langKey}.title"),
                    "description" => trans("{$langKey}.description"),
                    "key" => $categoryKey,
                ]);
            })
            ->values();

        $value = collect(config('cookie-consent.cookie_categories'))
            ->map(function ($category, $categoryKey) {
                return (new CookieUtils())->getValueFor($categoryKey, '1');
            });

        $hasManage = $categories
            ->some(function ($category) {
                return !($category['required'] ?? false);
            });

        $view->with(compact('alreadyConsentedWithCookies', 'value', 'categories', 'hasManage'));
    }
}