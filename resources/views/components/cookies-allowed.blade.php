
@if(config('cookie-consent.enabled'))
    <x-cookie-consent::script />

    <script>
        if(CookieConsent.hasConsented(@json($category)) {
            {!! str_replace(['<script>', '</script>'], ['', ''], trim($slot)) !!}
        }
    </script>
@endif
