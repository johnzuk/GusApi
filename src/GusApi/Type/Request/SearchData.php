<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\Type\SearchParameters;

class SearchData
{
    /**
     * @var SearchParameters
     */
    protected $pParametryWyszukiwania;

    public function __construct(SearchParameters $pParametryWyszukiwania)
    {
        $this->pParametryWyszukiwania = $pParametryWyszukiwania;
    }

    public function getPParametryWyszukiwania(): SearchParameters
    {
        return $this->pParametryWyszukiwania;
    }
}
