<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HistoricalDataController extends AbstractController
{
    #[Route(
        '/api/v1/historical-data',
        name: 'app_historical_data',
        methods:['GET'],
    )]
    public function index(Request $request): JsonResponse
    {
        return $this->json([]);
    }
}
