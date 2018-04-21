<?php

namespace GusApi\Type;

/**
 * Class DaneSzukajResponse
 *
 * @package GusApi\Type
 */
class SearchDataResponse
{
    /**
     * @var SearchResponseCompanyData[]
     */
    public $DaneSzukajResult = [];

    /**
     * @param SearchResponseCompanyData[] $DaneSzukajResult
     */
    public function __construct(array $DaneSzukajResult = [])
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
     * @param SearchResponseCompanyData[] $DaneSzukajResult
     *
     * @return SearchDataResponse
     */
    public function setDaneSzukajResult(array $DaneSzukajResult)
    {
        $this->DaneSzukajResult = $DaneSzukajResult;

        return $this;
    }
}
