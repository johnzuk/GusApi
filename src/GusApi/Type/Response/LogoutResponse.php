<?php

namespace GusApi\Type\Response;

class LogoutResponse
{
    /**
     * @var bool
     */
    public $WylogujResult;

    /**
     * @param bool $WylogujResult
     */
    public function __construct(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;
    }

    /**
     * @return bool
     */
    public function getWylogujResult(): bool
    {
        return $this->WylogujResult;
    }
}
