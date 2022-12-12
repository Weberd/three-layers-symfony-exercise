<?php

namespace App\Tests;

use App\Service\CacheServiceInterface;
use App\Service\FetchHistoricalDataService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class FetchHistoricalDataServiceTest extends TestCase
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testFetch(): void
    {
        $hc = $this->createMock(HttpClientInterface::class);
        $rc = $this->createMock(CacheServiceInterface::class);
        $r = $this->createMock(ResponseInterface::class);

        $rc->expects($this->once())->method('exists')->willReturn(false);
        $hc->expects($this->once())->method('request')->willReturn($r);

        $r->expects($this->once())->method('getContent')->willReturn('');

        $inputData = [
            'prices' => [
                [
                    "date" => 1670596200,
                    "open" => 1.190000057220459,
                    "high" => 1.2000000476837158,
                    "low" => 1.159999966621399,
                    "close" => 1.159999966621399,
                    "volume" => 3921300,
                    "adjclose" => 1.159999966621399
                ],
                [
                    "date" => 1670509800,
                    "open" => 1.190000057220459,
                    "high" => 1.2000000476837158,
                    "low" => 1.1399999856948853,
                    "close" => 1.2000000476837158,
                    "volume" => 4550800,
                    "adjclose" => 1.2000000476837158
                ],
                [
                    "date" => 1670423400,
                    "open" => 1.2000000476837158,
                    "high" => 1.2400000095367432,
                    "low" => 1.149999976158142,
                    "close" => 1.1699999570846558,
                    "volume" => 5036700,
                    "adjclose" => 1.1699999570846558
                ],
            ]
        ];

        $r->expects($this->once())->method('toArray')->willReturn($inputData);

        $fhds = new FetchHistoricalDataService($hc, $rc);
        $actualData = $fhds->fetch('AMZN', 1670422400, 1670596500);

        $expectedData = [
            [
                "date" => 1670423400,
                "open" => 1.2000000476837158,
                "high" => 1.2400000095367432,
                "low" => 1.149999976158142,
                "close" => 1.1699999570846558,
                "volume" => 5036700,
            ],
            [
                "date" => 1670509800,
                "open" => 1.190000057220459,
                "high" => 1.2000000476837158,
                "low" => 1.1399999856948853,
                "close" => 1.2000000476837158,
                "volume" => 4550800,
            ],
            [
                "date" => 1670596200,
                "open" => 1.190000057220459,
                "high" => 1.2000000476837158,
                "low" => 1.159999966621399,
                "close" => 1.159999966621399,
                "volume" => 3921300,
            ],
        ];

        $this->assertEquals($expectedData, $actualData);
    }
}
