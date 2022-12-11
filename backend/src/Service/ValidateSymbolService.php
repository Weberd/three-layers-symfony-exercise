<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class ValidateSymbolService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($symbol): bool
    {
        $repo = $this->em->getRepository(Company::class);
        return $repo->count(['symbol' => $symbol]) > 0;
    }
}