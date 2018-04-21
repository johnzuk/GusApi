<?php

namespace GusApi\Type;

/**
 * Class WylogujResponse
 *
 * @package GusApi\Type
 */
class LogoutResponse
{
    /**
     * @var bool
     */
    public $WylogujResult;

    /**
     * @param bool $WylogujResult
     */
    public function __construct(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;
    }

    /**
     * @return bool
     */
    public function getWylogujResult(): bool
    {
        return $this->WylogujResult;
    }

    /**
     * @param bool $WylogujResult
     *
     * @return LogoutResponse
     */
    public function setWylogujResult(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;

        return $this;
    }
}
