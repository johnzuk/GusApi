<?php

namespace GusApi\Type;

class DaneSzukaj
{

    /**
     * @var \GusApi\Type\ParametryWyszukiwania
     */
    private $pParametryWyszukiwania;

    /**
     * @return \GusApi\Type\ParametryWyszukiwania
     */
    public function getPParametryWyszukiwania()
    {
        return $this->pParametryWyszukiwania;
    }

    /**
     * @param \GusApi\Type\ParametryWyszukiwania $pParametryWyszukiwania
     * @return DaneSzukaj
     */
    public function withPParametryWyszukiwania($pParametryWyszukiwania)
    {
        $new = clone $this;
        $new->pParametryWyszukiwania = $pParametryWyszukiwania;

        return $new;
    }


}

