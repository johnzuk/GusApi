<?php

namespace GusApi\Type;

/**
 * Class DanePobierzPelnyRaport
 * @package GusApi\Type
 */
class DanePobierzPelnyRaport
{
    /**
     * @var string $pRegon
     */
    protected $pRegon;

    /**
     * @var string $pNazwaRaportu
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
     * @return DanePobierzPelnyRaport
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
     * @return DanePobierzPelnyRaport
     */
    public function setPNazwaRaportu(string $pNazwaRaportu)
    {
        $this->pNazwaRaportu = $pNazwaRaportu;
        return $this;
    }
}
