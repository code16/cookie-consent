
@if(config('cookie-consent.enabled'))
    <div id="cookie-consent" class="cookie-consent">
        @if(!$alreadyConsentedWithCookies)
            <x-cookie-consent::bar
                :theme="$theme"
                :has-manage="$hasManage"
                :backdrop="$backdrop"
            />
        @endif
        @if($hasManage)
            <x-cookie-consent::modal
                :theme="$theme"
            />
        @endif
    </div>

    @if($theme === 'bootstrap-vue')
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
@endif
