<?php

declare(strict_types=1);

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

    public function getRegon(): string
    {
        return $this->Regon;
    }

    public function getNip(): string
    {
        return $this->Nip;
    }

    public function getStatusNip(): string
    {
        return $this->StatusNip;
    }

    public function getNazwa(): string
    {
        return $this->Nazwa;
    }

    public function getWojewodztwo(): string
    {
        return $this->Wojewodztwo;
    }

    public function getPowiat(): string
    {
        return $this->Powiat;
    }

    public function getGmina(): string
    {
        return $this->Gmina;
    }

    public function getMiejscowosc(): string
    {
        return $this->Miejscowosc;
    }

    public function getKodPocztowy(): string
    {
        return $this->KodPocztowy;
    }

    public function getUlica(): string
    {
        return $this->Ulica;
    }

    public function getNrNieruchomosci(): string
    {
        return $this->NrNieruchomosci;
    }

    public function getNrLokalu(): string
    {
        return $this->NrLokalu;
    }

    public function getTyp(): string
    {
        return $this->Typ;
    }

    public function getSilosID(): int
    {
        return $this->SilosID;
    }

    public function getDataZakonczeniaDzialalnosci(): string
    {
        return $this->DataZakonczeniaDzialalnosci;
    }

    public function getMiejscowoscPoczty(): string
    {
        return $this->MiejscowoscPoczty;
    }
}
