<?php

namespace Code16\CookieConsent;

use Illuminate\Support\Facades\Cookie;

class CookieUtils
{
    public function serializeWithValues(array $values): string
    {
        $serialized = collect(config('cookie-consent.cookie_categories'))
            ->filter(function ($category, $key) {
                return !($category['required'] ?? false);
            })
            ->map(function ($category, $key) use ($values) {
                return "{$key}=" . ($values[$key] ?? true);
            })
            ->implode(',');

        return $serialized ?: 'all=1';
    }

    public function getValueFor(string $categoryKey, string $default): string
    {
        if ($cookie = Cookie::get(config('cookie-consent.cookie_name'))) {
            foreach (explode(',', $cookie) as $category) {
                if (str_contains($category, '=')) {
                    list($key, $value) = explode('=', $category);
                    if ($key == $categoryKey) {
                        return $value;
                    }
                }
            }
        }

        return $default;
    }
}