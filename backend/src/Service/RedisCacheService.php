<?php

namespace App\Service;

use Predis\Client;

final class RedisCacheService implements CacheServiceInterface
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'host' => $_ENV['REDIS_HOST'],
            'port' => $_ENV['REDIS_PORT']
        ]);
    }

    public function set(string $key, $value): void {
        $this->client->set($key, $value);
    }

    public function get(string $key): mixed {
        return $this->client->get($key);
    }

    public function exists(string $key): bool {
        return $this->client->exists($key);
    }

    public function expire(string $key, int $seconds): void {
        $this->client->expire($key, $seconds);
    }
}