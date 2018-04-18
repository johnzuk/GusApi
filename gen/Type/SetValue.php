<?php

namespace GusApi\Type;

class SetValue
{

    /**
     * @var string
     */
    private $pNazwaParametru;

    /**
     * @var string
     */
    private $pWartoscParametru;

    /**
     * @return string
     */
    public function getPNazwaParametru()
    {
        return $this->pNazwaParametru;
    }

    /**
     * @param string $pNazwaParametru
     * @return SetValue
     */
    public function withPNazwaParametru($pNazwaParametru)
    {
        $new = clone $this;
        $new->pNazwaParametru = $pNazwaParametru;

        return $new;
    }

    /**
     * @return string
     */
    public function getPWartoscParametru()
    {
        return $this->pWartoscParametru;
    }

    /**
     * @param string $pWartoscParametru
     * @return SetValue
     */
    public function withPWartoscParametru($pWartoscParametru)
    {
        $new = clone $this;
        $new->pWartoscParametru = $pWartoscParametru;

        return $new;
    }


}

