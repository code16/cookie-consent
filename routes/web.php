<?php

Route::post('/cookie-consent', function() {
    return redirect()->back()->cookie(
        config('cookie-consent.cookie_name'),
        (new \Code16\CookieConsent\CookieConsent())->serializeWithValues(request()->all()),
        config('cookie-consent.cookie_lifetime_in_minutes')
    );
})->name('cookie-consent');