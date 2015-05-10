<?php
namespace GusApi;

class ListsReport
{
    private $regon;
    private $name;
    private $province;
    private $district;
    private $commune;
    private $city;
    private $street;
    private $removeDate;

    public function __construct($response)
    {
        $this->regon = $response->lokpraw_regon14;
        $this->name = $response->lokpraw_nazwa;
        $this->province = $response->nazwaWojewodztwa;
        $this->district = $response->nazwaPowiatu;
        $this->commune = $response->nazwaGminy;
        $this->city = $response->nazwaMiejscowosci;
        $this->street = $response->nazwaUlicy;
        $this->removeDate = new \DateTime($response->dataSkresleniazRegon);
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
    public function getCommune()
    {
        return $this->commune;
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
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return \DateTime
     */
    public function getRemoveDate()
    {
        return $this->removeDate;
    }
}