<?php namespace spec\Mcamara\LaravelLocalization;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Config\Repository as Config;
use Illuminate\View\Factory      as View;
use Illuminate\Translation\Translator;

class LaravelLocalizationSpec extends ObjectBehavior
{
    function let(Config $config, View $view, Translator $translator)
    {
        $config->get('app.locale')->willReturn('en');
        $config->has('laravel-localization::languagesAllowed')->willReturn(false);
        $config->has('laravel-localization::supportedLanguages')->willReturn(false);
        $this->beConstructedWith($config, $view, $translator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Mcamara\LaravelLocalization\LaravelLocalization');
    }

    function it_throws_exception_if_default_locale_is_not_supported(Config $config, View $view, Translator $translator)
    {
        $config->get('laravel-localization::supportedLocales')->willReturn([]);
        $this->shouldThrow('Mcamara\LaravelLocalization\UnsupportedLocaleException')->during('__construct', array($config, $view, $translator));
    }

}
