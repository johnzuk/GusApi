<?php

namespace GusApi\Type\Response;

class LoginResponse
{
    /**
     * @var string
     */
    public $ZalogujResult = '';

    /**
     * @param string $ZalogujResult
     */
    public function __construct(string $ZalogujResult)
    {
        $this->ZalogujResult = $ZalogujResult;
    }

    /**
     * @return string
     */
    public function getZalogujResult(): string
    {
        return $this->ZalogujResult;
    }
}
