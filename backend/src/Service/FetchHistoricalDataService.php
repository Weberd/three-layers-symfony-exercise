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

        return $data;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function fetch(string $symbol, int $startDate, int $endDate): array
    {
        $response = $this->client->request(
            'GET',
            sprintf($_ENV['RAPI_API_URL'], $symbol),
            [
                'headers' => [
                    'X-RapidAPI-Host' => $_ENV['RAPID_API_HOST'],
                    'X-RapidAPI-Key'  => $_ENV['RAPID_API_KEY']
                ]
            ]
        );

        return $this->transformData($response->toArray(true));
    }
}