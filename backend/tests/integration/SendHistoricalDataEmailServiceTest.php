<?php

namespace App\Tests;

use App\Service\FetchCompanyNameService;
use App\Service\SendHistoricalDataEmailService;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridApiTransport;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;

class SendHistoricalDataEmailServiceTest extends KernelTestCase
{
    /**
     * @throws InvalidArgumentException
     * @throws TransportExceptionInterface
     */
    public function testSend(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);

        $fcn = $this->createMock(FetchCompanyNameService::class);
        $fcn->expects($this->any())->method('fetch')->willReturn('Amazon');

        $s = new SendHistoricalDataEmailService(
            new Mailer(new SendgridApiTransport($_ENV['SENDGRID_KEY'])),
            $fcn
        );
        $s->send('AMZN', strtotime('-7 days'), strtotime(''), 'weberdster@gmail.com');
    }
}
