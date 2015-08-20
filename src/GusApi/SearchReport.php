<?php
namespace GusApi;

use GusApi\Exception\InvalidTypeException;

class SearchReport
{
    private $regon;
    private $regon14;
    private $name;
    private $province;
    private $district;
    private $community;
    private $city;
    private $zipCode;
    private $street;
    private $type;
    private $silo;

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
        $this->type = $this->makeType($data->Typ);
        $this->regon14 = $this->makeRegon14($this->regon);
        $this->silo = $data->SilosID;
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

    /**
     * @return string
     */
    public function getRegon14()
    {
        return $this->regon14;
    }

    /**
     * @return mixed
     */
    public function getSilo()
    {
        return $this->silo;
    }

    private function makeRegon14($regon)
    {
        return str_pad($regon, 14, "0");
    }

    private function makeType($type)
    {
        $type = trim(strtolower($type));

        if ($type == 'p') {
            return 'DaneRaportPrawnaPubl';
        } else if ($type == 'f') {
            return 'DaneRaportFizycznaPubl';
        } else {
            throw new InvalidTypeException(sprintf("Invalid report type: %s", $type));
        }

    }
}