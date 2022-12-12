<?php

namespace App\Service;

interface ValidateSymbolInterface
{
    public function validate($symbol): bool;
}