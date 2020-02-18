<?php

namespace App\Helpers;

class Url
{
    /**
     * @param string $url
     * @return bool
     */
    public static function checkImageByUrl(string $url): bool
    {
        return is_array(@getimagesize($url));
    }

    /**
     * @param string $url
     * @return string
     */
    public static function getBaseUrl(string $url): string
    {
        if (parse_url($url, PHP_URL_SCHEME) && parse_url($url, PHP_URL_HOST)) {
            $resultUrl = parse_url($url);
            return $resultUrl['scheme'] . '://' . $resultUrl['host'];
        }
        return '';
    }
}