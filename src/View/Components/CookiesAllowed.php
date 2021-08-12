<?php

namespace Code16\CookieConsent\View\Components;

use Code16\CookieConsent\CookieUtils;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class CookiesAllowed extends Component
{
    public string $category;
    public bool $hasConsented;
    
    public function __construct(string $category)
    {
        $this->category = $category;
        $this->hasConsented = $category
            ? CookieUtils::hasConsented($category)
            : Cookie::has(config('cookie-consent.cookie_name'));
    }
    
    public function render()
    {
        return $this->hasConsented
            ? '{{ $slot }}'
            : null;
    }
}
