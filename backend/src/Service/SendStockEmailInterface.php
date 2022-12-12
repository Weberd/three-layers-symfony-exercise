<?php

namespace App\Service;

interface SendStockEmailInterface
{
    public function send(string $symbol, int $startDate, int $endDate, string $email): void;
}