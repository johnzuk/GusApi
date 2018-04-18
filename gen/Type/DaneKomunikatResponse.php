<?php

namespace GusApi\Type;

class DaneKomunikatResponse
{

    /**
     * @var string
     */
    private $DaneKomunikatResult;

    /**
     * @return string
     */
    public function getDaneKomunikatResult()
    {
        return $this->DaneKomunikatResult;
    }

    /**
     * @param string $DaneKomunikatResult
     * @return DaneKomunikatResponse
     */
    public function withDaneKomunikatResult($DaneKomunikatResult)
    {
        $new = clone $this;
        $new->DaneKomunikatResult = $DaneKomunikatResult;

        return $new;
    }


}

