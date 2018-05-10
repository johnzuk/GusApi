<?php

namespace GusApi\Type\Response;

class GetValueResponse
{
    /**
     * @var string
     */
    public $GetValueResult;

    /**
     * @param string $GetValueResult
     */
    public function __construct(string $GetValueResult)
    {
        $this->GetValueResult = $GetValueResult;
    }

    /**
     * @return string
     */
    public function getGetValueResult(): string
    {
        return $this->GetValueResult;
    }
}
