<?php

namespace GusApi\Type;

class SetValueResponse
{

    /**
     * @var string
     */
    private $SetValueResult;

    /**
     * @return string
     */
    public function getSetValueResult()
    {
        return $this->SetValueResult;
    }

    /**
     * @param string $SetValueResult
     * @return SetValueResponse
     */
    public function withSetValueResult($SetValueResult)
    {
        $new = clone $this;
        $new->SetValueResult = $SetValueResult;

        return $new;
    }


}

