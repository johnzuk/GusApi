<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class Login
{
    /**
     * @var string
     */
    protected $pKluczUzytkownika;

    public function __construct(string $pKluczUzytkownika)
    {
        $this->pKluczUzytkownika = $pKluczUzytkownika;
    }

    public function getPKluczUzytkownika(): string
    {
        return $this->pKluczUzytkownika;
    }
}
