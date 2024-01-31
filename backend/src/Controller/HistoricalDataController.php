<?php

namespace App\Controller;

use App\Request\RequestInterface;
use App\Service\FetchHistoricalDataInterface;
use App\Service\SendStockNotificationInterface;
use App\Service\ValidateSymbolInterface;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HistoricalDataController extends AbstractController
{
    /**
     * @throws InvalidArgumentException
     * @throws TransportExceptionInterface
     */
    #[Route(
        '/api/v1/historical-data',
        name: 'app_historical_data',
        methods:['GET'],
    )]
    public function index(
        RequestInterface           $historyDataRequest,
        ValidateSymbolInterface    $validateSymbolService,
        FetchHistoricalDataInterface $fetchHistoricalDataService,
        SendStockNotificationInterface $sendHistoricalDataEmailService
    ): JsonResponse
    {
        $historyDataRequest->validate();
        $symbol = $historyDataRequest->getRequest()->query->get('symbol');
        $startDate = $historyDataRequest->getRequest()->query->get('start_date');
        $endDate = $historyDataRequest->getRequest()->query->get('end_date');
        $email = $historyDataRequest->getRequest()->query->get('email');

        if (!$validateSymbolService->validate($symbol))
            return new JsonResponse('Wrong Symbol', 400);

        if ($startDate > $endDate)
            return new JsonResponse('start_date must be less or equal than end_date', 400);

        $data = $fetchHistoricalDataService->fetch($symbol, $startDate, $endDate);
        $sendHistoricalDataEmailService->send($symbol, $startDate, $endDate, $email);

        return $this->json($data);
    }
}
