<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchHistoricalDataService
{
    public function __construct(protected HttpClientInterface $client)
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

        $map = $this->transformData($response->toArray(true));
        $map = $this->sliceData($map, $startDate, $endDate);
        return $map;
    }
}