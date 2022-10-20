<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class SearchData implements RequestInterface
{
    public function __construct(public SearchParameters $pParametryWyszukiwania)
    {
    }

    public function toArray(): array
    {
        return [
            ParamName::SEARCH => $this->pParametryWyszukiwania->toArray(),
        ];
    }
}
