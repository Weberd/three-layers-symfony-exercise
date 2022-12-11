<?php

namespace App\Controller;

use App\Entity\Company;
use App\Service\AllCompanySymbolsService;
use App\Transformer\CompanySymbols2JsonTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SymbolsController extends AbstractController
{
    #[Route('/api/v1/symbols', name: 'app_symbols', methods:['GET'])]
    public function index(CompanySymbols2JsonTransformer $transformer, AllCompanySymbolsService $allCompanySymbolsService): JsonResponse
    {
        return $this->json(
            $transformer->transform($allCompanySymbolsService->getAllSymbols())
        );
    }
}
