<?php

namespace App\Service;

interface FetchCompanyNameInterface
{
    public function fetch(string $symbol): string;
}