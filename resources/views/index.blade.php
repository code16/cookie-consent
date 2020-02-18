@if(config('cookie-consent.enabled') && !$alreadyConsentedWithCookies)

    <div id="cookie-consent" v-cloak>
        @include('cookieConsent::bar')
        @if($hasManage)
            @include('cookieConsent::modal')
        @endif
    </div>

    <script src="{{ url(mix('/cookie-consent.js', '/vendor/cookie-consent')) }}" async></script>
@endif