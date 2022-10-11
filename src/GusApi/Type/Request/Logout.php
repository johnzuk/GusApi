<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class Logout
{
    /**
     * @var string
     */
    protected $pIdentyfikatorSesji;

    public function __construct(string $pIdentyfikatorSesji)
    {
        $this->pIdentyfikatorSesji = $pIdentyfikatorSesji;
    }

    public function getPIdentyfikatorSesji(): string
    {
        return $this->pIdentyfikatorSesji;
    }
}
