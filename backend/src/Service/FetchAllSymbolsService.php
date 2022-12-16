<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

final class FetchAllSymbolsService implements FetchAllSymbolsInterface
{
    public function __construct(private EntityManagerInterface $em) {}

    public function fetch(): array
    {
        $repo = $this->em->getRepository(Company::class);
        return $repo->findAll();
    }
}