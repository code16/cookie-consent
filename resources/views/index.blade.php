@if(config('cookie-consent.enabled') && !$alreadyConsentedWithCookies)

    <div id="cookie-consent">
        @include('cookieConsent::bar')
        @if($hasManage)
            @include('cookieConsent::modal')
        @endif
    </div>

    <script src="{{ asset('/vendor/cookie-consent/cookie-consent.js') }}" async></script>
@endif