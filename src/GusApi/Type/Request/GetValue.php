<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class GetValue implements RequestInterface
{
    public function __construct(private string $pNazwaParametru)
    {
    }

    public function toArray(): array
    {
        return [
            ParamName::PARAM_NAME => $this->pNazwaParametru,
        ];
    }
}
