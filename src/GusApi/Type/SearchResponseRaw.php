<?php

namespace GusApi\Type;

/**
 * Class DaneSzukajResponseRaw
 *
 * @package GusApi\Type
 */
class SearchResponseRaw
{
    /**
     * @var string
     */
    protected $DaneSzukajResult = '';

    /**
     * @param string $DaneSzukajResult
     */
    public function __construct(string $DaneSzukajResult)
    {
        $this->DaneSzukajResult = $DaneSzukajResult;
    }

    /**
     * @return string
     */
    public function getDaneSzukajResult(): string
    {
        return $this->DaneSzukajResult;
    }

    /**
     * @param string $DaneSzukajResult
     *
     * @return SearchResponseRaw
     */
    public function setDaneSzukajResult(string $DaneSzukajResult)
    {
        $this->DaneSzukajResult = $DaneSzukajResult;

        return $this;
    }
}
