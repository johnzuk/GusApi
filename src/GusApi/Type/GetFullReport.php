<?php

namespace GusApi\Type;

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
     * @param string $pRegon
     *
     * @return GetFullReport
     */
    public function setPRegon(string $pRegon)
    {
        $this->pRegon = $pRegon;

        return $this;
    }

    /**
     * @return string
     */
    public function getPNazwaRaportu(): string
    {
        return $this->pNazwaRaportu;
    }

    /**
     * @param string $pNazwaRaportu
     *
     * @return GetFullReport
     */
    public function setPNazwaRaportu(string $pNazwaRaportu)
    {
        $this->pNazwaRaportu = $pNazwaRaportu;

        return $this;
    }
}
