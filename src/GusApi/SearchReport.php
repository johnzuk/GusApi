<?php
namespace GusApi;

/**
 * Class SearchReport
 * @package GusApi
 */
class SearchReport
{
    /**
     * @var string
     */
    private $regon;

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
     * SearchReport constructor.
     * @param $data
     */
    function __construct($data)
    {
        $this->regon = (string)$data->Regon;
        $this->name = (string)$data->Nazwa;
        $this->province = (string)$data->Wojewodztwo;
        $this->district = (string)$data->Powiat;
        $this->community = (string)$data->Gmina;
        $this->city = (string)$data->Miejscowosc;
        $this->zipCode = (string)$data->KodPocztowy;
        $this->street = (string)$data->Ulica;
        $this->type = $this->makeType((string)$data->Typ);
        $this->regon14 = $this->makeRegon14($this->regon);
        $this->silo = (int)$data->SilosID;
    }

    /**
     * Get REGON number
     *
     * @return string REGON number
     */
    public function getRegon()
    {
        return $this->regon;
    }

    /**
     * Get subject name
     *
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get province name
     *
     * @return string province name
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Get distinct name
     *
     * @return string distinct name
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Get community name
     *
     * @return string community name
     */
    public function getCommunity()
    {
        return $this->community;
    }

    /**
     * Get city
     *
     * @return string city name
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get zip code
     *
     * @return string zip code
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Get street name
     *
     * @return string street name
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get type name
     *
     * @return string type name
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getRegon14()
    {
        return $this->regon14;
    }

    /**
     * @return int
     */
    public function getSilo()
    {
        return $this->silo;
    }

    /**
     * @param string $regon
     * @return string
     */
    private function makeRegon14($regon)
    {
        return str_pad($regon, 14, "0");
    }

    /**
     * @param string $type
     * @return string
     */
    private function makeType($type)
    {
        return trim(strtolower($type));
    }
}