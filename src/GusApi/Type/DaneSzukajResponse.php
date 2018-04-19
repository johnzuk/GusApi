<?php

namespace GusApi\Type;

/**
 * Class DaneSzukajResponse
 * @package GusApi\Type
 */
class DaneSzukajResponse
{
    /**
     * @var DaneSzukajResponseElement[] $DaneSzukajResult
     */
    public $DaneSzukajResult = [];

    /**
     * @param DaneSzukajResponseElement[] $DaneSzukajResult
     */
    public function __construct(array $DaneSzukajResult)
    {
        $this->DaneSzukajResult = $DaneSzukajResult;
    }

    /**
     * @return array
     */
    public function getDaneSzukajResult(): array
    {
        return $this->DaneSzukajResult;
    }

    /**
     * @param DaneSzukajResponseElement[] $DaneSzukajResult
     * @return DaneSzukajResponse
     */
    public function setDaneSzukajResult(array $DaneSzukajResult)
    {
        $this->DaneSzukajResult = $DaneSzukajResult;
        return $this;
    }
}
