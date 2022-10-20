<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetValueResponse
{
    public function __construct(public string $GetValueResult)
    {
    }

    public function getGetValueResult(): string
    {
        return $this->GetValueResult;
    }
}
