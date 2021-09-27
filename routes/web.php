<?php

Route::post('/cookie-consent',
    function () {
        return redirect()
            ->back()
            ->cookie(
                config('cookie-consent.cookie_name'),
                \Code16\CookieConsent\CookieUtils::serializeWithValues(request()->all()),
                config('cookie-consent.cookie_lifetime_in_minutes')
            );
    })
    ->name('cookie-consent')
    ->middleware(config('cookie-consent.middleware') ?: []);


Route::get('/cookie-consent',
    function () {
        return response('Ok', 200)->cookie(
            config('cookie-consent.cookie_name'),
            \Code16\CookieConsent\CookieUtils::serializeWithValues(request()->all()),
            config('cookie-consent.cookie_lifetime_in_minutes'),
            null,
            null,
            false,
            false
        );
    })
    ->name('cookie-consent.xhr');
