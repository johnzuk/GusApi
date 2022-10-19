<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class GetBulkReport implements RequestInterface
{
    private string $pDataRaportu;
    private string $pNazwaRaportu;

    public function __construct(string $pDataRaportu, string $pNazwaRaportu)
    {
        $this->pDataRaportu = $pDataRaportu;
        $this->pNazwaRaportu = $pNazwaRaportu;
    }

    public function toArray(): array
    {
        return [
            ParamName::REPORT_DATE => $this->pDataRaportu,
            ParamName::REPORT_NAME => $this->pNazwaRaportu,
        ];
    }
}
