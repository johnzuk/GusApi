<?php

namespace GusApi\Type;

/**
 * Class WylogujResponse
 * @package GusApi\Type
 */
class WylogujResponse
{
    /**
     * @var boolean $WylogujResult
     */
    public $WylogujResult;

    /**
     * @param boolean $WylogujResult
     */
    public function __construct(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;
    }

    /**
     * @return boolean
     */
    public function getWylogujResult(): bool
    {
        return $this->WylogujResult;
    }

    /**
     * @param boolean $WylogujResult
     * @return WylogujResponse
     */
    public function setWylogujResult(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;
        return $this;
    }
}
