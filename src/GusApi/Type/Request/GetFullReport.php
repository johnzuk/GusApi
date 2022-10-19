<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class GetFullReport implements RequestInterface
{
    public string $pRegon;
    public string $pNazwaRaportu;

    public function __construct(string $pRegon, string $pNazwaRaportu)
    {
        $this->pRegon = $pRegon;
        $this->pNazwaRaportu = $pNazwaRaportu;
    }

    public function toArray(): array
    {
        return [
            ParamName::REGON => $this->pRegon,
            ParamName::REPORT_NAME => $this->pNazwaRaportu,
        ];
    }
}
