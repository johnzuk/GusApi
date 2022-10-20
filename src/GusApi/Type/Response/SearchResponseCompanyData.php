<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class SearchResponseCompanyData
{
    public string $Regon = '';
    public string $Nip = '';
    public string $StatusNip = '';
    public string $Nazwa = '';
    public string $Wojewodztwo = '';
    public string $Powiat = '';
    public string $Gmina = '';
    public string $Miejscowosc = '';
    public string $KodPocztowy = '';
    public string $Ulica = '';
    public string $NrNieruchomosci = '';
    public string $NrLokalu = '';
    public string $Typ = '';
    public string $SilosID = '0';
    public string $DataZakonczeniaDzialalnosci = '';
    public string $MiejscowoscPoczty = '';

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

    public function getSilosID(): string
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
