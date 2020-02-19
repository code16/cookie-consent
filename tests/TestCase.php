<?php

namespace Code16\CookieConsent\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [\Code16\CookieConsent\CookieConsentServiceProvider::class];
    }
}