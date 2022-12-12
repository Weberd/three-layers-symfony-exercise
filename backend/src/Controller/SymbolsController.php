<?php

namespace App\Controller;

use App\Service\FetchAllSymbolsInterface;
use App\Service\FetchAllSymbolsService;
use App\Transformer\CompanyTransformerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SymbolsController extends AbstractController
{
    #[Route('/api/v1/symbols', name: 'app_symbols', methods:['GET'])]
    public function index(CompanyTransformerInterface $transformer, FetchAllSymbolsInterface $allCompanySymbolsService): JsonResponse
    {
        return $this->json(
            $transformer->transform($allCompanySymbolsService->fetch())
        );
    }
}
