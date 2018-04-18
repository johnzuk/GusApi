<?php

namespace GusApi\Type;

class GetValueResponse
{

    /**
     * @var string
     */
    private $GetValueResult;

    /**
     * @return string
     */
    public function getGetValueResult()
    {
        return $this->GetValueResult;
    }

    /**
     * @param string $GetValueResult
     * @return GetValueResponse
     */
    public function withGetValueResult($GetValueResult)
    {
        $new = clone $this;
        $new->GetValueResult = $GetValueResult;

        return $new;
    }


}

