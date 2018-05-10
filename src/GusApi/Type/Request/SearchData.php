<?php

namespace GusApi\Type\Request;

use GusApi\Type\SearchParameters;

class SearchData
{
    /**
     * @var SearchParameters
     */
    protected $pParametryWyszukiwania;

    /**
     * @param SearchParameters $pParametryWyszukiwania
     */
    public function __construct(SearchParameters $pParametryWyszukiwania)
    {
        $this->pParametryWyszukiwania = $pParametryWyszukiwania;
    }

    /**
     * @return SearchParameters
     */
    public function getPParametryWyszukiwania(): SearchParameters
    {
        return $this->pParametryWyszukiwania;
    }
}
