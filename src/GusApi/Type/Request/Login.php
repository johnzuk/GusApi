<?php

namespace GusApi\Type\Request;

class Login
{
    /**
     * @var string
     */
    protected $pKluczUzytkownika;

    /**
     * @param string $pKluczUzytkownika
     */
    public function __construct(string $pKluczUzytkownika)
    {
        $this->pKluczUzytkownika = $pKluczUzytkownika;
    }

    /**
     * @return string
     */
    public function getPKluczUzytkownika(): string
    {
        return $this->pKluczUzytkownika;
    }
}
