<?php

namespace App\Tests;

use App\Entity\Company;
use App\Transformer\CompanySymbols2JsonTransformer;
use PHPUnit\Framework\TestCase;

class CompanySymbols2JsonTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $t = new CompanySymbols2JsonTransformer();
        $c1 = new Company();
        $c1->setSymbol('AMZN');
        $c1->setName('Amazon');
        $c2 = new Company();
        $c2->setSymbol('AAPL');
        $c2->setName('Apple');

        $this->assertEquals([
            'AMZN', 'AAPL'
        ], $t->transform([$c1,$c2]));
    }
}
