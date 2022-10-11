<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class GetValue
{
    /**
     * @var string
     */
    protected $pNazwaParametru;

    public function __construct(string $pNazwaParametru)
    {
        $this->pNazwaParametru = $pNazwaParametru;
    }

    public function getPNazwaParametru(): string
    {
        return $this->pNazwaParametru;
    }
}
