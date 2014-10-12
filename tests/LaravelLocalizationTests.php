<?php

class LaravelLocalizationTests extends TestsBase {

    public function testDefaultsAndSetLocale()
    {
        $this->assertEquals('es', LaravelLocalization::setLocale('es'));
        $this->assertNull(LaravelLocalization::setLocale('ja'));
        $this->assertEquals('es', LaravelLocalization::getCurrentLocale());


        $this->assertEquals('en', LaravelLocalization::setLocale('en'));
        $this->assertEquals('en', LaravelLocalization::getCurrentLocale());

        LaravelLocalization::setLocale('es');
        $this->assertEquals('es', LaravelLocalization::getCurrentLocale());
    }

    public function testAcceptLanguageDetection1()
    {
        $crawler = $this->call('GET', '/hello', array(), array(), array("HTTP_ACCEPT_LANGUAGE"=>"de,es,en"));

        $this->assertResponseOk();
        $this->assertEquals('hello world', $crawler->getContent());
        $this->assertEquals('es', LaravelLocalization::getCurrentLocale());
        $this->assertNotEquals('en', LaravelLocalization::getCurrentLocale());
        $this->assertNotEquals('de', LaravelLocalization::getCurrentLocale());
    }

    public function testAcceptLanguageDetection2()
    {
        $crawler = $this->call('GET', '/hello', array(), array(), array("HTTP_ACCEPT_LANGUAGE"=>"en,de,es"));

        $this->assertResponseOk();
        $this->assertEquals('hello world', $crawler->getContent());
        $this->assertEquals('en', LaravelLocalization::getCurrentLocale());
        $this->assertNotEquals('es', LaravelLocalization::getCurrentLocale());
        $this->assertNotEquals('de', LaravelLocalization::getCurrentLocale());
    }

} 