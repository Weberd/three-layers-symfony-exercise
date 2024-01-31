<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;

class HistoricDataRequest extends BaseRequest
{
    #[NotBlank()]
    public $symbol;

    #[NotBlank()]
    #[Type('numeric')]
    #[Positive()]
    public $start_date;

    #[NotBlank()]
    #[Type('numeric')]
    #[Positive()]
    public $end_date;

    #[NotBlank()]
    #[Email()]
    public $email;
}