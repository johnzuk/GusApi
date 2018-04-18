<?php

namespace GusApi\Type;

class GetValue
{

    /**
     * @var string
     */
    private $pNazwaParametru;

    /**
     * @return string
     */
    public function getPNazwaParametru()
    {
        return $this->pNazwaParametru;
    }

    /**
     * @param string $pNazwaParametru
     * @return GetValue
     */
    public function withPNazwaParametru($pNazwaParametru)
    {
        $new = clone $this;
        $new->pNazwaParametru = $pNazwaParametru;

        return $new;
    }


}

