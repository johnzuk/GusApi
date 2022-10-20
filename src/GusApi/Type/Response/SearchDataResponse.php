<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class SearchDataResponse
{
    /**
     * @param SearchResponseCompanyData[] $DaneSzukajResult
     */
    public function __construct(public array $DaneSzukajResult = [])
    {
    }

    /**
     * @return SearchResponseCompanyData[]
     */
    public function getDaneSzukajResult(): array
    {
        return $this->DaneSzukajResult;
    }
}
