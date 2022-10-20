<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class LoginResponse
{
    public function __construct(public string $ZalogujResult)
    {
    }

    public function getZalogujResult(): string
    {
        return $this->ZalogujResult;
    }
}
