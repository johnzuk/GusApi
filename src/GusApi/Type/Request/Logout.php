<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

use GusApi\ParamName;

final class Logout implements RequestInterface
{
    public string $sessionId;

    public function __construct(string $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function toArray(): array
    {
        return [
            ParamName::SESSION_ID => $this->sessionId,
        ];
    }
}
