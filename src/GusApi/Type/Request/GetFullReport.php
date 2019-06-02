<?php

namespace GusApi\Type\Request;

class GetFullReport
{
    /**
     * @var string
     */
    protected $pRegon;

    /**
     * @var string
     */
    protected $pNazwaRaportu;

    /**
     * @param string $pRegon
     * @param string $pNazwaRaportu
     */
    public function __construct(string $pRegon, string $pNazwaRaportu)
    {
        $this->pRegon = $pRegon;
        $this->pNazwaRaportu = $pNazwaRaportu;
    }

    /**
     * @return string
     */
    public function getPRegon(): string
    {
        return $this->pRegon;
    }

    /**
     * @return string
     */
    public function getPNazwaRaportu(): string
    {
        return $this->pNazwaRaportu;
    }
}
