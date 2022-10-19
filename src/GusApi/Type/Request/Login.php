<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class Login implements RequestInterface
{
    private string $userKey;

    public function __construct(string $userKey)
    {
        $this->userKey = $userKey;
    }

    public function toArray(): array
    {
        return [
            ParamName::USER_KEY => $this->userKey,
        ];
    }
}
