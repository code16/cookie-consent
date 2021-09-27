
@if(config('cookie-consent.enabled'))
    <div id="cookie-consent" class="cookie-consent">
        <x-cookie-consent::bar
            :theme="$theme"
            :has-manage="$hasManage"
            :backdrop="$backdrop"
        />
        @if($hasManage)
            <x-cookie-consent::modal
                :theme="$theme"
            />
        @endif
    </div>

    <x-cookie-consent::script />

    @if($theme === 'bootstrap-vue')
        <script>
            const enabled = CookieConsent.hasConsented() || document.querySelector('a[href^="#manage-cookies"]');
            if(enabled) {
                const script = document.createElement('script');
                script.async = true;
                script.src = "{{ url(mix('/bootstrap-vue/cookie-consent.js', '/vendor/cookie-consent')) }}";
                document.head.appendChild(script);
            }
        </script>
    @else
        <script>
            CookieConsent.setup();
        </script>
    @endif
@endif
