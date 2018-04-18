<?php

namespace GusApi\Type;

class Zaloguj
{

    /**
     * @var string
     */
    private $pKluczUzytkownika;

    /**
     * @return string
     */
    public function getPKluczUzytkownika()
    {
        return $this->pKluczUzytkownika;
    }

    /**
     * @param string $pKluczUzytkownika
     * @return Zaloguj
     */
    public function withPKluczUzytkownika($pKluczUzytkownika)
    {
        $new = clone $this;
        $new->pKluczUzytkownika = $pKluczUzytkownika;

        return $new;
    }


}

