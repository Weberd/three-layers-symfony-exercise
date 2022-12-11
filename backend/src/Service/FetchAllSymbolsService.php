<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class FetchAllSymbolsService
{
    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function getAllSymbols(): array
    {
        $repo = $this->em->getRepository(Company::class);
        return $repo->findAll();
    }
}