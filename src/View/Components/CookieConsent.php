<?php

namespace Code16\CookieConsent\View\Components;

use Code16\CookieConsent\CookieUtils;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class CookieConsent extends Component
{
    public bool $alreadyConsentedWithCookies;
    public bool $hasManage;
    public string $theme;
    public bool $backdrop;
    
    public function __construct(
        string $theme,
        bool $backdrop = false
    ) {
        $this->alreadyConsentedWithCookies = Cookie::has(config('cookie-consent.cookie_name'));
        $this->hasManage = config('cookie-consent.has_manage_modal');
        $this->theme = $theme;
        $this->backdrop = $backdrop;
    }
    
    public function render()
    {
        return view('cookie-consent::components.cookie-consent');
    }
}
