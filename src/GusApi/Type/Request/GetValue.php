<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class GetValue implements RequestInterface
{
    private string $pNazwaParametru;

    public function __construct(string $pNazwaParametru)
    {
        $this->pNazwaParametru = $pNazwaParametru;
    }

    public function toArray(): array
    {
        return [
            ParamName::PARAM_NAME => $this->pNazwaParametru,
        ];
    }
}
