<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class FetchAllSymbolsService implements FetchAllSymbolsInterface
{
    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function fetch(): array
    {
        $repo = $this->em->getRepository(Company::class);
        return $repo->findAll();
    }
}