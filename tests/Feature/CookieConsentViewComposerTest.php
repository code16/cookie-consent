<?php

namespace Code16\CookieConsent\Tests\Feature;

use Code16\CookieConsent\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class CookieConsentViewComposerTest extends TestCase
{
    /** @test */
    function we_send_alreadyConsentedWithCookies_to_false_if_the_consent_cookie_is_missing()
    {
        $this->get('/')
            ->assertOk()
            // NB for some reason related to testing in Orchestra we can use ->assertViewHas here...
            ->assertSee('var hasConsented = false');
    }

    /** @test */
    function we_send_alreadyConsentedWithCookies_to_true_if_the_consent_cookie_is_there()
    {
        $this
            ->call('get', '/', [], [config('cookie-consent.cookie_name') => "all=1"])
            ->assertOk()
            // NB for some reason related to testing in Orchestra we can use ->assertViewHas here...
            ->assertSee('var hasConsented = true');
    }

    /** @test */
    function we_display_the_bar_if_the_consent_cookie_is_missing()
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('cookie-consent-bar');
    }

    /** @test */
    function we_dont_display_the_bar_if_the_consent_cookie_is_there()
    {
        $this
            ->call('get', '/', [], [config('cookie-consent.cookie_name') => "all=1"])
            ->assertOk()
            ->assertDontSee('cookie-consent-bar');
    }

    /** @test */
    function we_add_the_modal_if_the_consent_cookie_is_missing_and_there_are_cookies_to_manage()
    {
        config()->set('cookie-consent.cookie_categories', [
            'system' => [
                'required' => true,
            ],
            'analytics' => [
                'required' => false,
            ],
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('cookie-manage-modal');
    }

    /** @test */
    function we_dont_add_the_modal_if_the_consent_cookie_is_missing_and_there_are_no_cookies_to_manage()
    {
        config()->set('cookie-consent.cookie_categories', [
            'system' => [
                'required' => true,
            ],
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('cookie-manage-modal');
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [
            dirname(__DIR__) . '/fixtures/'
        ]);

        if (!file_exists(public_path('vendor/cookie-consent'))) {
            mkdir(public_path('vendor/cookie-consent'), 0777, true);
        }
        touch(public_path('vendor/cookie-consent/mix-manifest.json'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/', function () {
            return view('testing-view');
        });
    }
}