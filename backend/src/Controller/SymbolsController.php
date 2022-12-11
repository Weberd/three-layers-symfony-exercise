<?php

namespace App\Controller;

use App\Service\FetchAllSymbolsService;
use App\Transformer\CompanySymbols2JsonTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SymbolsController extends AbstractController
{
    #[Route('/api/v1/symbols', name: 'app_symbols', methods:['GET'])]
    public function index(CompanySymbols2JsonTransformer $transformer, FetchAllSymbolsService $allCompanySymbolsService): JsonResponse
    {
        return $this->json(
            $transformer->transform($allCompanySymbolsService->getAllSymbols())
        );
    }
}
