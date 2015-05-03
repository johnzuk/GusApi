<?php
namespace GusApi;

class SearchReport
{
    private $regon;
    private $name;
    private $province;
    private $district;
    private $community;
    private $city;
    private $zipCode;
    private $street;
    private $type;

    function __construct($data)
    {
        $this->regon = $data->Regon;
        $this->name = $data->Nazwa;
        $this->province = $data->Wojewodztwo;
        $this->district = $data->Powiat;
        $this->community = $data->Gmina;
        $this->city = $data->Miejscowosc;
        $this->zipCode = $data->KodPocztowy;
        $this->street = $data->Ulica;
        $this->type = $data->Typ;
    }

    /**
     * @return mixed
     */
    public function getRegon()
    {
        return $this->regon;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @return mixed
     */
    public function getCommunity()
    {
        return $this->community;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}