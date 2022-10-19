<?php

declare(strict_types=1);

namespace GusApi;

use GusApi\Type\Response\SearchResponseCompanyData;
use JsonSerializable;

class SearchReport implements JsonSerializable
{
    public const TYPE_JURIDICAL_PERSON = 'p';

    public const TYPE_NATURAL_PERSON = 'f';

    public const TYPE_LOCAL_ENTITY_JURIDICAL_PERSON = 'lp';

    public const TYPE_LOCAL_ENTITY_NATURAL_PERSON = 'lf';

    private string $regon;

    private string $nip;

    private string $nipStatus;

    private string $regon14;

    private string $name;

    private string $province;

    private string $district;

    private string $community;

    private string $city;

    private string $propertyNumber;

    private string $apartmentNumber;

    private string $zipCode;

    private string $street;

    private string $type;

    private int $silo;

    private string $activityEndDate;

    private string $postCity;

    public function __construct(SearchResponseCompanyData $data)
    {
        $this->regon = $data->getRegon();
        $this->nip = $data->getNip();
        $this->nipStatus = $data->getStatusNip();
        $this->name = $data->getNazwa();
        $this->province = $data->getWojewodztwo();
        $this->district = $data->getPowiat();
        $this->community = $data->getGmina();
        $this->city = $data->getMiejscowosc();
        $this->zipCode = $data->getKodPocztowy();
        $this->street = $data->getUlica();
        $this->propertyNumber = $data->getNrNieruchomosci();
        $this->apartmentNumber = $data->getNrLokalu();
        $this->type = $this->makeType($data->getTyp());
        $this->regon14 = $this->makeRegon14($this->getRegon());
        $this->silo = (int) $data->getSilosID();
        $this->activityEndDate = $data->getDataZakonczeniaDzialalnosci();
        $this->postCity = $data->getMiejscowoscPoczty();
    }

    public function getRegon(): string
    {
        return $this->regon;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function getCommunity(): string
    {
        return $this->community;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRegon14(): string
    {
        return $this->regon14;
    }

    public function getSilo(): int
    {
        return $this->silo;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function getNipStatus(): string
    {
        return $this->nipStatus;
    }

    public function getPropertyNumber(): string
    {
        return $this->propertyNumber;
    }

    public function getApartmentNumber(): string
    {
        return $this->apartmentNumber;
    }

    public function getActivityEndDate(): string
    {
        return $this->activityEndDate;
    }

    public function getPostCity(): string
    {
        return $this->postCity;
    }

    private function makeRegon14(string $regon): string
    {
        return str_pad($regon, 14, '0');
    }

    private function makeType(string $type): string
    {
        return trim(strtolower($type));
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
