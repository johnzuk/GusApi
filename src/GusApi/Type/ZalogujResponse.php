<?php
namespace GusApi\Type;

/**
 * Class ZalogujResponse
 * @package GusApi\Type
 */
class ZalogujResponse
{
    /**
     * @var string $ZalogujResult
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
     * @return ZalogujResponse
     */
    public function setZalogujResult(string $ZalogujResult)
    {
        $this->ZalogujResult = $ZalogujResult;
        return $this;
    }
}
