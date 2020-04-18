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
    public $Nip = '';

    /**
     * @var string
     */
    public $StatusNip = '';
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
    public $NrNieruchomosci = '';

    /**
     * @var string
     */
    public $NrLokalu = '';

    /**
     * @var string
     */
    public $Typ = '';

    /**
     * @var int
     */
    public $SilosID = 0;

    /**
     * @var string
     */
    public $DataZakonczeniaDzialalnosci = '';

    /**
     * @var string
     */
    public $MiejscowoscPoczty = '';

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
    public function getNip(): string
    {
        return $this->Nip;
    }

    /**
     * @return string
     */
    public function getStatusNip(): string
    {
        return $this->StatusNip;
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
    public function getNrNieruchomosci(): string
    {
        return $this->NrNieruchomosci;
    }

    /**
     * @return string
     */
    public function getNrLokalu(): string
    {
        return $this->NrLokalu;
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

    /**
     * @return string
     */
    public function getDataZakonczeniaDzialalnosci(): string
    {
        return $this->DataZakonczeniaDzialalnosci;
    }

    /**
     * @return string
     */
    public function getMiejscowoscPoczty(): string
    {
        return $this->MiejscowoscPoczty;
    }
}
