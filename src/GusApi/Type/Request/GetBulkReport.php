<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class GetBulkReport
{
    /**
     * @var string
     */
    protected $pDataRaportu;

    /**
     * @var string
     */
    protected $pNazwaRaportu;

    /**
     * GetBulkReport constructor.
     */
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
