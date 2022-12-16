<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FetchHistoricalDataService implements FetchHistoricalDataInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly CacheServiceInterface $redisCacheService
    ) {}

    private function transformData($data): array
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

    private function sliceData($map, $startDate, $endDate): array
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
     * @param string $symbol
     * @param int $startDate
     * @param int $endDate
     * @return array
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function fetch(string $symbol, int $startDate, int $endDate): array
    {
        if ($this->redisCacheService->exists($symbol)) {
            $data = json_decode($this->redisCacheService->get($symbol), true);
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

            $this->redisCacheService->set($symbol, $response->getContent(false));
            $data = $response->toArray(true);
        }

        $map = $this->transformData($data);
        return $this->sliceData($map, $startDate, $endDate);
    }
}