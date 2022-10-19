<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class LogoutResponse
{
    public bool $WylogujResult;

    public function __construct(bool $WylogujResult)
    {
        $this->WylogujResult = $WylogujResult;
    }

    public function getWylogujResult(): bool
    {
        return $this->WylogujResult;
    }
}
