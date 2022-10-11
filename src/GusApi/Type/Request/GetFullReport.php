<?php

declare(strict_types=1);

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

    public function __construct(string $pRegon, string $pNazwaRaportu)
    {
        $this->pRegon = $pRegon;
        $this->pNazwaRaportu = $pNazwaRaportu;
    }

    public function getPRegon(): string
    {
        return $this->pRegon;
    }

    public function getPNazwaRaportu(): string
    {
        return $this->pNazwaRaportu;
    }
}
