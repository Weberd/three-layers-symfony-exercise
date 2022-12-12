<?php

namespace App\Tests;

use App\Entity\Company;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testGettersSetters(): void
    {
        $c = new Company();
        $c->setSymbol('AMZN');
        $c->setName('Amazon Inc.');

        $this->assertEquals('AMZN', $c->getSymbol());
        $this->assertEquals('Amazon Inc.', $c->getName());
    }
}
