<?php

namespace App\Tests;

use App\Entity\Company;
use App\Service\FetchCompanyNameService;
use App\Service\SendHistoricalDataNotificationService;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
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

        $c = new Company();
        $c->setName('Amazon');
        $c->setSymbol('AMZN');
        $em = static::getContainer()->get(EntityManagerInterface::class);
        $em->persist($c);
        $em->flush();

        $s = new SendHistoricalDataNotificationService(
            new Mailer(new SendgridApiTransport($_ENV['SENDGRID_KEY'])),
            new FetchCompanyNameService($em)
        );
        $s->send('AMZN', strtotime('-7 days'), strtotime(''), 'weberdster@gmail.com');
    }
}
