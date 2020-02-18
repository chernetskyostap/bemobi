<?php

namespace App\Classes;

use App\Interfaces\IUrlChecker;
use App\Helpers\Url;
use PHPHtmlParser\Dom;

class UrlChecker implements IUrlChecker
{
    public const DEFAULT_URL = 'https://google.com';
    private string $url;
    private Dom $dom;

    public function __construct(string $url)
    {
        $this->url = $url ? $url : self::DEFAULT_URL;
        $this->dom = new Dom;
    }

    /**
     * @return array
     */
    public function getBrokenImages(): array
    {
        try {
            $html = $this->dom->loadFromUrl($this->url);
            $images = $html->find('img');

            $imageSources = [];
            $baseUrl = Url::getBaseUrl($this->url);
            foreach ($images as $image) {
                $imageLink = $image->getAttribute('src');
                if (!parse_url($imageLink, PHP_URL_SCHEME)) {
                    $imageLink = $baseUrl . $imageLink;
                }
                if (!Url::checkImageByUrl($imageLink)) {
                    $imageSources[] = $imageLink;
                }
            }
            return $imageSources;
        } catch (\Exception $exception) {
            // логирование ошибок
        }
        return [];
    }

    /**
     * @return array
     */
    public function getAllLinks(): array
    {
        try {
            $html = $this->dom->loadFromUrl($this->url);
            $links = $html->find('a');

            $hrefAttributes = [];
            $baseUrl = Url::getBaseUrl($this->url);
            foreach ($links as $link) {
                $attribute = $link->getAttribute('href');
                if (!parse_url($attribute, PHP_URL_SCHEME)) {
                    $attribute = $baseUrl . $attribute;
                }
                $hrefAttributes[] = $attribute;
            }
            return $hrefAttributes;
        } catch (\Exception $exception) {
            // логирование ошибок
        }
        return [];
    }
}