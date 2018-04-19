<?php

namespace GusApi\Type;

/**
 * Class DaneSzukaj
 * @package GusApi\Type
 */
class DaneSzukaj
{
    /**
     * @var ParametryWyszukiwania $pParametryWyszukiwania
     */
    protected $pParametryWyszukiwania = null;

    /**
     * @param ParametryWyszukiwania $pParametryWyszukiwania
     */
    public function __construct(ParametryWyszukiwania $pParametryWyszukiwania)
    {
        $this->pParametryWyszukiwania = $pParametryWyszukiwania;
    }

    /**
     * @return ParametryWyszukiwania
     */
    public function getPParametryWyszukiwania(): ParametryWyszukiwania
    {
        return $this->pParametryWyszukiwania;
    }

    /**
     * @param ParametryWyszukiwania $pParametryWyszukiwania
     * @return DaneSzukaj
     */
    public function setPParametryWyszukiwania(ParametryWyszukiwania $pParametryWyszukiwania)
    {
        $this->pParametryWyszukiwania = $pParametryWyszukiwania;
        return $this;
    }
}
