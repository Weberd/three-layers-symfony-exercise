<?php

namespace App\Service;

interface FetchHistoricalDataInterface
{
    public function fetch(string $symbol, int $startDate, int $endDate): array;
}