<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestInterface
{
    public function getRequest(): Request;
    public function validate();
}