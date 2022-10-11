<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class LoginResponse
{
    /**
     * @var string
     */
    public $ZalogujResult = '';

    public function __construct(string $ZalogujResult)
    {
        $this->ZalogujResult = $ZalogujResult;
    }

    public function getZalogujResult(): string
    {
        return $this->ZalogujResult;
    }
}
