<?php

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
     *
     * @param string $pDataRaportu
     * @param string $pNazwaRaportu
     */
    public function __construct(string $pDataRaportu, string $pNazwaRaportu)
    {
        $this->pDataRaportu = $pDataRaportu;
        $this->pNazwaRaportu = $pNazwaRaportu;
    }

    /**
     * @return string
     */
    public function getPDataRaportu(): string
    {
        return $this->pDataRaportu;
    }

    /**
     * @return string
     */
    public function getPNazwaRaportu(): string
    {
        return $this->pNazwaRaportu;
    }
}
