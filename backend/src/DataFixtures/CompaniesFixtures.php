<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompaniesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $companiesJson = json_decode(file_get_contents(__DIR__ . '/companies.json'), true);

        foreach ($companiesJson as $companyJson) {
             $company = new Company();
             $company->setSymbol($companyJson['Symbol']);
             $company->setName($companyJson['Company Name']);
             $manager->persist($company);
        }

        $manager->flush();
    }
}
