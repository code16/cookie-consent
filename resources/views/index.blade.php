
@if(config('cookie-consent.enabled'))
    <div id="cookie-consent" class="cookie-consent" style="display: none">
        @if(!$alreadyConsentedWithCookies)
            @include('cookieConsent::bar')
        @endif
        @if($hasManage)
            @include('cookieConsent::modal')
        @endif
    </div>

    <script>
        var hasConsented = @json($alreadyConsentedWithCookies);
        var enabled = !hasConsented || document.querySelector('a[href^="#manage-cookies"]');
        if(enabled) {
            var script = document.createElement('script');
            script.async = true;
            script.src = "{{ url(mix('/cookie-consent.js', '/vendor/cookie-consent')) }}";
            document.head.appendChild(script);
        }
    </script>
@endif