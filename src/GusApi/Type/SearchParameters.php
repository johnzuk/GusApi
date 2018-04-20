<?php

namespace GusApi\Type;

/**
 * Class ParametryWyszukiwania
 * @package GusApi\Type
 */
class SearchParameters
{
    /**
     * @var string $Krs
     */
    protected $Krs = null;

    /**
     * @var string $Krsy
     */
    protected $Krsy = null;

    /**
     * @var string $Nip
     */
    protected $Nip = null;

    /**
     * @var string $Nipy
     */
    protected $Nipy = null;

    /**
     * @var string $Regon
     */
    protected $Regon = null;

    /**
     * @var string $Regony14zn
     */
    protected $Regony14zn = null;

    /**
     * @var string $Regony9zn
     */
    protected $Regony9zn = null;

    /**
     * @return string
     */
    public function getKrs()
    {
        return $this->Krs;
    }

    /**
     * @param string $Krs
     * @return SearchParameters
     */
    public function setKrs($Krs)
    {
        $this->Krs = $Krs;
        return $this;
    }

    /**
     * @return string
     */
    public function getKrsy()
    {
        return $this->Krsy;
    }

    /**
     * @param string $Krsy
     * @return SearchParameters
     */
    public function setKrsy($Krsy)
    {
        $this->Krsy = $Krsy;
        return $this;
    }

    /**
     * @return string
     */
    public function getNip()
    {
        return $this->Nip;
    }

    /**
     * @param string $Nip
     * @return SearchParameters
     */
    public function setNip($Nip)
    {
        $this->Nip = $Nip;
        return $this;
    }

    /**
     * @return string
     */
    public function getNipy()
    {
        return $this->Nipy;
    }

    /**
     * @param string $Nipy
     * @return SearchParameters
     */
    public function setNipy($Nipy)
    {
        $this->Nipy = $Nipy;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegon()
    {
        return $this->Regon;
    }

    /**
     * @param string $Regon
     * @return SearchParameters
     */
    public function setRegon($Regon)
    {
        $this->Regon = $Regon;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegony14zn()
    {
        return $this->Regony14zn;
    }

    /**
     * @param string $Regony14zn
     * @return SearchParameters
     */
    public function setRegony14zn($Regony14zn)
    {
        $this->Regony14zn = $Regony14zn;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegony9zn()
    {
        return $this->Regony9zn;
    }

    /**
     * @param string $Regony9zn
     * @return SearchParameters
     */
    public function setRegony9zn($Regony9zn)
    {
        $this->Regony9zn = $Regony9zn;
        return $this;
    }
}
