<?php

namespace GusApi\Type;

class ZalogujResponse
{

    /**
     * @var string
     */
    private $ZalogujResult;

    /**
     * @return string
     */
    public function getZalogujResult()
    {
        return $this->ZalogujResult;
    }

    /**
     * @param string $ZalogujResult
     * @return ZalogujResponse
     */
    public function withZalogujResult($ZalogujResult)
    {
        $new = clone $this;
        $new->ZalogujResult = $ZalogujResult;

        return $new;
    }


}

