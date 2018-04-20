<?php
namespace GusApi\Type;

/**
 * Class DaneSzukajResponseRaw
 * @package GusApi\Type
 */
class SearchResponseRaw
{
    /**
     * @var string $DaneSzukajResult
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
     * @return SearchResponseRaw
     */
    public function setDaneSzukajResult(string $DaneSzukajResult)
    {
        $this->DaneSzukajReslt = $DaneSzukajResult;
        return $this;
    }
}
