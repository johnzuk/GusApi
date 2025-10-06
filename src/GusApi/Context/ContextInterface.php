<?php

declare(strict_types=1);

namespace GusApi\Context;

interface ContextInterface
{
    /**
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options): bool;

    /**
     * @param array<string, mixed> $parameters
     */
    public function setParameters(array $parameters): bool;

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array;

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array;

    /**
     * @return resource
     */
    public function getContext();
}
