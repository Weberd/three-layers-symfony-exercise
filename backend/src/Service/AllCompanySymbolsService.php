<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class AllCompanySymbolsService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAllSymbols(): array
    {
        $repo = $this->em->getRepository(Company::class);
        return $repo->findAll();
    }
}