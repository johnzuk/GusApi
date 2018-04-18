<?php

namespace GusApi\Type;

class ParametryWyszukiwania
{

    /**
     * @var string
     */
    private $Krs;

    /**
     * @var string
     */
    private $Krsy;

    /**
     * @var string
     */
    private $Nip;

    /**
     * @var string
     */
    private $Nipy;

    /**
     * @var string
     */
    private $Regon;

    /**
     * @var string
     */
    private $Regony14zn;

    /**
     * @var string
     */
    private $Regony9zn;

    /**
     * @return string
     */
    public function getKrs()
    {
        return $this->Krs;
    }

    /**
     * @param string $Krs
     * @return ParametryWyszukiwania
     */
    public function withKrs($Krs)
    {
        $new = clone $this;
        $new->Krs = $Krs;

        return $new;
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
     * @return ParametryWyszukiwania
     */
    public function withKrsy($Krsy)
    {
        $new = clone $this;
        $new->Krsy = $Krsy;

        return $new;
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
     * @return ParametryWyszukiwania
     */
    public function withNip($Nip)
    {
        $new = clone $this;
        $new->Nip = $Nip;

        return $new;
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
     * @return ParametryWyszukiwania
     */
    public function withNipy($Nipy)
    {
        $new = clone $this;
        $new->Nipy = $Nipy;

        return $new;
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
     * @return ParametryWyszukiwania
     */
    public function withRegon($Regon)
    {
        $new = clone $this;
        $new->Regon = $Regon;

        return $new;
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
     * @return ParametryWyszukiwania
     */
    public function withRegony14zn($Regony14zn)
    {
        $new = clone $this;
        $new->Regony14zn = $Regony14zn;

        return $new;
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
     * @return ParametryWyszukiwania
     */
    public function withRegony9zn($Regony9zn)
    {
        $new = clone $this;
        $new->Regony9zn = $Regony9zn;

        return $new;
    }


}

