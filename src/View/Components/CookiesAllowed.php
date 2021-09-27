<?php

namespace Code16\CookieConsent\View\Components;

use Code16\CookieConsent\CookieUtils;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class CookiesAllowed extends Component
{
    public ?string $category;
    
    public function __construct(?string $category = null)
    {
        $this->category = $category;
    }
    
    public function render()
    {
        return view('cookie-consent::components.cookies-allowed');
    }
}
