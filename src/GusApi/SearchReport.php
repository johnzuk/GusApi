<?php

namespace GusApi;

use GusApi\Type\Response\SearchResponseCompanyData;
use JsonSerializable;

class SearchReport implements JsonSerializable
{
    const TYPE_JURIDICAL_PERSON = 'p';

    const TYPE_NATURAL_PERSON = 'f';

    const TYPE_LOCAL_ENTITY_JURIDICAL_PERSON = 'lp';

    const TYPE_LOCAL_ENTITY_NATURAL_PERSON = 'lf';

    /**
     * @var string
     */
    private $regon;

    /**
     * @var string
     */
    private $nip;

    /**
     * @var string
     */
    private $nipStatus;

    /**
     * @var string
     */
    private $regon14;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $community;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $propertyNumber;

    /**
     * @var string
     */
    private $apartmentNumber;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $silo;

    /**
     * @var string
     */
    private $activityEndDate;

    /**
     * @var string
     */
    private $postCity;

    /**
     * SearchReport constructor.
     *
     * @param SearchResponseCompanyData $data
     */
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
        $this->silo = $data->getSilosID();
        $this->activityEndDate = $data->getDataZakonczeniaDzialalnosci();
        $this->postCity = $data->getMiejscowoscPoczty();
    }

    /**
     * Get REGON number.
     *
     * @return string REGON number
     */
    public function getRegon(): string
    {
        return $this->regon;
    }

    /**
     * Get subject name.
     *
     * @return string name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get province name.
     *
     * @return string province name
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * Get distinct name.
     *
     * @return string distinct name
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * Get community name.
     *
     * @return string community name
     */
    public function getCommunity(): string
    {
        return $this->community;
    }

    /**
     * Get city.
     *
     * @return string city name
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Get zip code.
     *
     * @return string zip code
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * Get street name.
     *
     * @return string street name
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Get type name.
     *
     * @return string type name
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getRegon14(): string
    {
        return $this->regon14;
    }

    /**
     * @return int
     */
    public function getSilo(): int
    {
        return $this->silo;
    }

    /**
     * @return string
     */
    public function getNip(): string
    {
        return $this->nip;
    }

    /**
     * @return string
     */
    public function getNipStatus(): string
    {
        return $this->nipStatus;
    }

    /**
     * @return string
     */
    public function getPropertyNumber(): string
    {
        return $this->propertyNumber;
    }

    /**
     * @return string
     */
    public function getApartmentNumber(): string
    {
        return $this->apartmentNumber;
    }

    /**
     * @return string
     */
    public function getActivityEndDate(): string
    {
        return $this->activityEndDate;
    }

    /**
     * @return string
     */
    public function getPostCity(): string
    {
        return $this->postCity;
    }

    /**
     * @param string $regon
     *
     * @return string
     */
    private function makeRegon14(string $regon): string
    {
        return \str_pad($regon, 14, '0');
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function makeType($type): string
    {
        return \trim(\strtolower($type));
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return \get_object_vars($this);
    }
}
