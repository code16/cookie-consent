<?php

namespace Code16\CookieConsent\View\Components;

use Code16\CookieConsent\CookieUtils;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Modal extends Component
{
    public Collection $categories;
    public Collection $value;
    public string $theme = '';
    
    public function __construct(string $theme)
    {
        $this->categories = $this->getCategories();
        $this->value = $this->getValue();
        $this->theme = $theme;
    }
    
    protected function getCategories(): Collection
    {
        return collect(config('cookie-consent.cookie_categories'))
            ->map(function ($category, $categoryKey) {
                $langKey = "cookieConsent::texts.manage.categories.{$categoryKey}";
                return array_merge($category, [
                    "title" => trans("{$langKey}.title"),
                    "description" => trans("{$langKey}.description"),
                    "key" => $categoryKey,
                    "required" => $category['required'] ?? false,
                ]);
            })
            ->values();
    }
    
    protected function getValue(): Collection
    {
        return collect(config('cookie-consent.cookie_categories'))
            ->map(function ($category, $categoryKey) {
                return CookieUtils::getValueFor($categoryKey, '1');
            });
    }
    
    public function render()
    {
        return view('cookie-consent::components.modal');
    }
}
