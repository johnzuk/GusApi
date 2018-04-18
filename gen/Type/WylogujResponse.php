<?php

namespace GusApi\Type;

class WylogujResponse
{

    /**
     * @var bool
     */
    private $WylogujResult;

    /**
     * @return bool
     */
    public function getWylogujResult()
    {
        return $this->WylogujResult;
    }

    /**
     * @param bool $WylogujResult
     * @return WylogujResponse
     */
    public function withWylogujResult($WylogujResult)
    {
        $new = clone $this;
        $new->WylogujResult = $WylogujResult;

        return $new;
    }


}

