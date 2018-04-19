<?php
namespace GusApi\Type;

/**
 * Class Zaloguj
 * @package GusApi\Type
 */
class Zaloguj
{
    /**
     * @var string $pKluczUzytkownika
     */
    protected $pKluczUzytkownika = null;

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

    /**
     * @param string $pKluczUzytkownika
     * @return Zaloguj
     */
    public function setPKluczUzytkownika(string $pKluczUzytkownika)
    {
        $this->pKluczUzytkownika = $pKluczUzytkownika;
        return $this;
    }
}
