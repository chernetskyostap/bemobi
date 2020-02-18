<?php

namespace App\Interfaces;

interface IUrlChecker {
    public function getBrokenImages(): array;
    public function getAllLinks(): array;
}