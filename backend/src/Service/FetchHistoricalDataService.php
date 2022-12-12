<?php

namespace App\Service;

use Doctrine\Common\Cache\Psr6\CacheAdapter;
use Predis\Client;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchHistoricalDataService
{
    public function __construct(
        protected HttpClientInterface $client,
        protected CacheService $cacheService
    )
    {
    }

    protected function transformData($data): array
    {
        $data = $data['prices'];
        $map = [];

        foreach ($data as $entry) {
            $date = $entry['date'];
            unset($entry['adjclose']);
            $map[$date] = $entry;
        }

        ksort($map, SORT_NUMERIC);
        return $map;
    }

    protected function sliceData($map, $startDate, $endDate): array
    {
        $slice = [];

        foreach ($map as $key => $value) {
            if ($key >= $startDate && $key <= $endDate)
                $slice[] = $value;

            if ($key >= $endDate) {
                break;
            }
        }

        return $slice;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function fetch(string $symbol, int $startDate, int $endDate): array
    {
        if ($this->cacheService->exists($symbol)) {
            $data = json_decode($this->cacheService->get($symbol), true);
        } else {
            $response = $this->client->request(
                'GET',
                sprintf($_ENV['RAPID_API_URL'], $symbol),
                [
                    'headers' => [
                        'X-RapidAPI-Host' => $_ENV['RAPID_API_HOST'],
                        'X-RapidAPI-Key'  => $_ENV['RAPID_API_KEY']
                    ]
                ]
            );

            $this->cacheService->set($symbol, $response->getContent(false));
            $data = $response->toArray(true);
        }

        $map = $this->transformData($data);
        $map = $this->sliceData($map, $startDate, $endDate);
        return $map;
    }
}