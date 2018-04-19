<?php

namespace GusApi\Type;

/**
 * Class GetValue
 * @package GusApi\Type
 */
class GetValue
{
    /**
     * @var string $pNazwaParametru
     */
    protected $pNazwaParametru;

    /**
     * @param string $pNazwaParametru
     */
    public function __construct(string $pNazwaParametru)
    {
        $this->pNazwaParametru = $pNazwaParametru;
    }

    /**
     * @return string
     */
    public function getPNazwaParametru(): string
    {
        return $this->pNazwaParametru;
    }

    /**
     * @param string $pNazwaParametru
     * @return GetValue
     */
    public function setPNazwaParametru(string $pNazwaParametru)
    {
        $this->pNazwaParametru = $pNazwaParametru;
        return $this;
    }
}
