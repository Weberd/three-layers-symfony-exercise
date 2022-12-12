<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;

class FetchCompanyNameService implements FetchCompanyNameInterface
{
    public function __construct(protected EntityManagerInterface $em)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function fetch(string $symbol): string
    {
        $repo = $this->em->getRepository(Company::class);
        $company = $repo->findOneBy(['symbol' => $symbol]);
        if (!$company) throw new InvalidArgumentException('Company name not found for symbol: $symbol');
        return $company->getName();
    }
}