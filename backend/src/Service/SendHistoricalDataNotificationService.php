<?php

namespace App\Service;

use DateTime;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Exception;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class SendHistoricalDataNotificationService implements SendStockNotificationInterface
{
    public function __construct(
        private readonly MailerInterface    $mailer,
        private readonly FetchCompanyNameInterface $fetchCompanyNameService
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    public function send(string $symbol, int $startDate, int $endDate, string $email): void
    {
        try {
            $startDateText = date('YYY-mm-dd', $startDate);
            $endDateText = date('YYY-mm-dd', $endDate);

            $email = (new Email())
                ->from($_ENV['FROM_MAILER_ADDRESS'])
                ->to($email)
                ->subject($this->fetchCompanyNameService->fetch($symbol))
                ->text("From $startDateText to $endDateText");

            $this->mailer->send($email);
        } catch (TransportException $e) {

        }
    }
}