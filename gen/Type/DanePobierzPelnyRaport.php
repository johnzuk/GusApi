<?php

namespace GusApi\Type;

class DanePobierzPelnyRaport
{

    /**
     * @var string
     */
    private $pRegon;

    /**
     * @var string
     */
    private $pNazwaRaportu;

    /**
     * @return string
     */
    public function getPRegon()
    {
        return $this->pRegon;
    }

    /**
     * @param string $pRegon
     * @return DanePobierzPelnyRaport
     */
    public function withPRegon($pRegon)
    {
        $new = clone $this;
        $new->pRegon = $pRegon;

        return $new;
    }

    /**
     * @return string
     */
    public function getPNazwaRaportu()
    {
        return $this->pNazwaRaportu;
    }

    /**
     * @param string $pNazwaRaportu
     * @return DanePobierzPelnyRaport
     */
    public function withPNazwaRaportu($pNazwaRaportu)
    {
        $new = clone $this;
        $new->pNazwaRaportu = $pNazwaRaportu;

        return $new;
    }


}

