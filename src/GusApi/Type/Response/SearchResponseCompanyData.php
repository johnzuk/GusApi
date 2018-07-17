<?php

namespace GusApi\Type\Response;

class SearchResponseCompanyData
{
    /**
     * @var string
     */
    public $Regon = '';

    /**
     * @var string
     */
    public $RegonLink = '';

    /**
     * @var string
     */
    public $Nazwa = '';

    /**
     * @var string
     */
    public $Wojewodztwo = '';

    /**
     * @var string
     */
    public $Powiat = '';

    /**
     * @var string
     */
    public $Gmina = '';

    /**
     * @var string
     */
    public $Miejscowosc = '';

    /**
     * @var string
     */
    public $KodPocztowy = '';

    /**
     * @var string
     */
    public $Ulica = '';

    /**
     * @var string
     */
    public $Typ = '';

    /**
     * @var int
     */
    public $SilosID = '';

    /**
     * @return string
     */
    public function getRegon(): string
    {
        return $this->Regon;
    }

    /**
     * @return string
     */
    public function getRegonLink(): string
    {
        return $this->RegonLink;
    }

    /**
     * @return string
     */
    public function getNazwa(): string
    {
        return $this->Nazwa;
    }

    /**
     * @return string
     */
    public function getWojewodztwo(): string
    {
        return $this->Wojewodztwo;
    }

    /**
     * @return string
     */
    public function getPowiat(): string
    {
        return $this->Powiat;
    }

    /**
     * @return string
     */
    public function getGmina(): string
    {
        return $this->Gmina;
    }

    /**
     * @return string
     */
    public function getMiejscowosc(): string
    {
        return $this->Miejscowosc;
    }

    /**
     * @return string
     */
    public function getKodPocztowy(): string
    {
        return $this->KodPocztowy;
    }

    /**
     * @return string
     */
    public function getUlica(): string
    {
        return $this->Ulica;
    }

    /**
     * @return string
     */
    public function getTyp(): string
    {
        return $this->Typ;
    }

    /**
     * @return int
     */
    public function getSilosID(): int
    {
        return $this->SilosID;
    }
}
