<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class ValidateSymbolService implements ValidateSymbolInterface
{
    public function __construct(protected EntityManagerInterface $em)
    {}

    public function validate($symbol): bool
    {
        $repo = $this->em->getRepository(Company::class);
        return $repo->count(['symbol' => $symbol]) > 0;
    }
}