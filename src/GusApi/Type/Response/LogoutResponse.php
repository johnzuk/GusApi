<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class LogoutResponse
{
    /**
     * @var bool
     */
    public $WylogujResult;

    public function __construct(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;
    }

    public function getWylogujResult(): bool
    {
        return $this->WylogujResult;
    }
}
