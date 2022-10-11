<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class GetBulkReport
{
    private string $pDataRaportu;

    private string $pNazwaRaportu;

    public function __construct(string $pDataRaportu, string $pNazwaRaportu)
    {
        $this->pDataRaportu = $pDataRaportu;
        $this->pNazwaRaportu = $pNazwaRaportu;
    }

    public function getPDataRaportu(): string
    {
        return $this->pDataRaportu;
    }

    public function getPNazwaRaportu(): string
    {
        return $this->pNazwaRaportu;
    }
}
