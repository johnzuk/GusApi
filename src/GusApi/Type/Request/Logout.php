<?php

namespace GusApi\Type\Request;

class Logout
{
    /**
     * @var string
     */
    protected $pIdentyfikatorSesji;

    /**
     * @param string $pIdentyfikatorSesji
     */
    public function __construct(string $pIdentyfikatorSesji)
    {
        $this->pIdentyfikatorSesji = $pIdentyfikatorSesji;
    }

    /**
     * @return string
     */
    public function getPIdentyfikatorSesji(): string
    {
        return $this->pIdentyfikatorSesji;
    }
}
