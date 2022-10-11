<?php

declare(strict_types=1);

namespace GusApi\Context;

interface ContextInterface
{
    public function setOptions(array $options): bool;

    public function setParameters(array $parameters): bool;

    public function getOptions(): array;

    public function getParameters(): array;

    /**
     * @return resource
     */
    public function getContext();
}
