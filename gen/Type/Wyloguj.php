<?php

namespace GusApi\Type;

class Wyloguj
{

    /**
     * @var string
     */
    private $pIdentyfikatorSesji;

    /**
     * @return string
     */
    public function getPIdentyfikatorSesji()
    {
        return $this->pIdentyfikatorSesji;
    }

    /**
     * @param string $pIdentyfikatorSesji
     * @return Wyloguj
     */
    public function withPIdentyfikatorSesji($pIdentyfikatorSesji)
    {
        $new = clone $this;
        $new->pIdentyfikatorSesji = $pIdentyfikatorSesji;

        return $new;
    }


}

