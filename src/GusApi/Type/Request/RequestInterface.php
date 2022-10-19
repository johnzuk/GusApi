<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

interface RequestInterface
{
    /**
     * @return array<string, string|int|null|array>
     */
    public function toArray(): array;
}
