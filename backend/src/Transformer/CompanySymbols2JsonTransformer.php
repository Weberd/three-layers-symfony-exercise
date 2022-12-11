<?php

namespace App\Transformer;

class CompanySymbols2JsonTransformer
{
    public function transform(array $companies)
    {
        $json = [];

        foreach ($companies as $company) {
            $json[] = $company->getSymbol();
        }

        return $json;
    }
}