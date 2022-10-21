<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

interface RequestInterface
{
    /**
     * @return array<string, string|int|array|null>
     */
    public function toArray(): array;
}
