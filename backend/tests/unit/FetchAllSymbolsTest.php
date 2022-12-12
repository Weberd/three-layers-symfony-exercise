<?php

namespace App\Tests;

use App\Service\FetchAllSymbolsService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;

class FetchAllSymbolsTest extends TestCase
{
    public function testFetch(): void
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $repo = $this->createMock(EntityRepository::class);

        $em->expects($this->once())->method('getRepository')->willReturn($repo);
        $repo->expects($this->once())->method('findAll')->willReturn(['AMZN']);

        $fas = new FetchAllSymbolsService($em);

        $this->assertEquals(['AMZN'], $fas->fetch());
    }
}
