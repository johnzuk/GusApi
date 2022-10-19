<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class SearchData implements RequestInterface
{
    public SearchParameters $pParametryWyszukiwania;

    public function __construct(SearchParameters $pParametryWyszukiwania)
    {
        $this->pParametryWyszukiwania = $pParametryWyszukiwania;
    }

    public function toArray(): array
    {
        return [
            ParamName::SEARCH => $this->pParametryWyszukiwania->toArray(),
        ];
    }
}
