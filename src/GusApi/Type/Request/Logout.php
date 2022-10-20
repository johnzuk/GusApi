<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class Logout implements RequestInterface
{
    public function __construct(public string $sessionId)
    {
    }

    public function toArray(): array
    {
        return [
            ParamName::SESSION_ID => $this->sessionId,
        ];
    }
}
