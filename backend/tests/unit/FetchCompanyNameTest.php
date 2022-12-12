<?php

namespace App\Tests;

use App\Entity\Company;
use App\Service\FetchCompanyNameService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;

class FetchCompanyNameTest extends TestCase
{
    public function testFetch(): void
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $repo = $this->createMock(EntityRepository::class);

        $em->expects($this->once())->method('getRepository')->willReturn($repo);
        $c = new Company();
        $c->setSymbol('AMZN');
        $c->setName('Amazon');
        $repo->expects($this->once())->method('findOneBy')->willReturn($c);

        $fas = new FetchCompanyNameService($em);

        $this->assertEquals('Amazon', $fas->fetch('AMZN'));
    }
}
