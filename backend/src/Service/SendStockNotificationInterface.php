<?php

namespace App\Service;

interface SendStockNotificationInterface
{
    public function send(string $symbol, int $startDate, int $endDate, string $email): void;
}