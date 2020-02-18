<?php

use PHPUnit\Framework\TestCase;
use App\Classes\UrlChecker;
use App\Helpers\Url;

class UrlTest extends TestCase
{
    public function testLinksFromEmptyUrl()
    {
        $urlChecker = new UrlChecker('');
        $result = $urlChecker->getAllLinks();
        $this->assertIsArray($result);
    }

    public function testGetAllLinks()
    {
        $urlChecker = new UrlChecker('https://olx.ua');
        $result = $urlChecker->getAllLinks();
        $this->assertIsArray($result);
    }

    public function testBrokenImages()
    {
        $urlChecker = new UrlChecker('https://opu.ua/staff');
        $result = $urlChecker->getBrokenImages();
        $this->assertIsArray($result);
    }

    public function testCheckImageByWrongUrl()
    {
        $url = 'https://www.linkedin.com/';
        $result = Url::checkImageByUrl($url);
        $this->assertFalse($result);
    }

    public function testGetBaseUrl()
    {
        $url = 'https://test.com';
        $result = Url::getBaseUrl($url);
        $this->assertIsString($result);
    }

    public function testGetBaseUrlFromEmpty()
    {
        $url = '';
        $result = Url::getBaseUrl($url);
        $this->assertEquals($result, $url);
    }
}