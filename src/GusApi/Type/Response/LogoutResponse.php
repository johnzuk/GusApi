<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class LogoutResponse
{
    public function __construct(public bool $WylogujResult)
    {
    }

    public function getWylogujResult(): bool
    {
        return $this->WylogujResult;
    }
}
