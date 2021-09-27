
@if(config('cookie-consent.enabled'))
    <div id="cookie-consent" class="cookie-consent">
        @if(!$alreadyConsentedWithCookies || config('cookie-consent.xhr'))
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
            const hasConsented = @json($alreadyConsentedWithCookies);
            const enabled = !hasConsented || document.querySelector('a[href^="#manage-cookies"]');
            if(enabled) {
                const script = document.createElement('script');
                script.async = true;
                script.src = "{{ url(mix('/cookie-consent.js', '/vendor/cookie-consent')) }}";
                document.head.appendChild(script);
            }
        </script>
    @else
        <script>
            ;(function () {
                const cookieName = @json(config('cookie-consent.cookie_name'));
                const hasConsented = document.cookie.indexOf(cookieName) !== -1;
                if(!hasConsented) {
                    document.body.classList.add('cc-visible');
                }
                @if(config('cookie-consent.xhr'))
                    if(hasConsented) {
                        appendScript();
                    }
                    Array.prototype.forEach
                        .call(document.querySelectorAll('[data-cc-form]'), function (form) {
                            form.addEventListener('submit', handleSubmit);
                        });
                    function handleSubmit(e) {
                        e.preventDefault();

                        const xhr = new XMLHttpRequest();
                        xhr.onload = function() {
                            if(hasConsented) {
                                location.reload();
                            } else {
                                document.body.classList.remove('cc-visible');
                                appendScript();
                            }
                        }
                        xhr.open('get', @json(route('cookie-consent.xhr')));
                        xhr.send(new FormData(e.target));
                    }
                    function appendScript() {
                        const script = document.createElement('script');
                        script.src = @json(config('cookie-consent.xhr_script_file'));
                        document.head.appendChild(script);
                    }
                @endif
            })();
        </script>
    @endif
@endif
