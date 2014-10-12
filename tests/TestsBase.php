<?php

use Orchestra\Testbench\TestCase;

abstract class TestsBase extends TestCase {

    protected function getPackageProviders()
    {
        return array('Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider');
    }

    protected function getPackageAliases()
    {
        return array(
            'LaravelLocalization'   => 'Mcamara\LaravelLocalization\Facades\LaravelLocalization'
        );
    }

    public function setUp()
    {
        parent::setUp();

        //$this->app['router']->enableFilters();
    }

    /**
     * Define environment setup.
     *
     * @param Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-localization::supportedLocales',
            array(
                "en" => array("name" => "English",		"script" => "Latin",		"dir" => "ltr",		"native" => "English"),
                "es" => array("name" => "Spanish",		"script" => "Latin",		"dir" => "ltr",		"native" => "Español"),
            )
        );
        $app['config']->set('laravel-localization::useAcceptLanguageHeader', true);
        $app['config']->set('laravel-localization::useSessionLocale', true);
        $app['config']->set('laravel-localization::useCookieLocale', true);
        $app['config']->set('laravel-localization::hideDefaultLocaleInURL', false);

        $app['router']->get('/hello', function () {
            //This needs to be in here for cookie, header, and session testing.
            LaravelLocalization::setLocale();
            return 'hello world';
        });
    }

}
