<?php

require "vendor/autoload.php";
use App\Classes\UrlChecker;

$url = 'https://opu.ua/staff';

$url = new UrlChecker($url);
//$url->getBrokenImages();
$result = $url->getAllLinks();

var_dump($result);
