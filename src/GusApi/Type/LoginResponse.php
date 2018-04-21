<?php

namespace GusApi\Type;

/**
 * Class ZalogujResponse
 *
 * @package GusApi\Type
 */
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

    /**
     * @param string $ZalogujResult
     *
     * @return LoginResponse
     */
    public function setZalogujResult(string $ZalogujResult)
    {
        $this->ZalogujResult = $ZalogujResult;

        return $this;
    }
}
