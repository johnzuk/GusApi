<?php

namespace GusApi\Type\Response;

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
     * @return SearchResponseCompanyData[]
     */
    public function getDaneSzukajResult(): array
    {
        return $this->DaneSzukajResult;
    }
}
