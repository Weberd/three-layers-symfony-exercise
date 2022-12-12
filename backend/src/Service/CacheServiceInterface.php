<?php

namespace App\Service;

interface CacheServiceInterface
{
    public function set(string $key, $value): void;
    public function get(string $key): mixed;
    public function exists(string $key): bool;
    public function expire(string $key, int $seconds): void;
}