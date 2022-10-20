<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class GetFullReport implements RequestInterface
{
    public function __construct(public string $pRegon, public string $pNazwaRaportu)
    {
    }

    public function toArray(): array
    {
        return [
            ParamName::REGON => $this->pRegon,
            ParamName::REPORT_NAME => $this->pNazwaRaportu,
        ];
    }
}
