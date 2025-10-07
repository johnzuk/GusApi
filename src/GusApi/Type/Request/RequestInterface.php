<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

interface RequestInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
