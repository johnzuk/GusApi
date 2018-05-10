<?php

namespace GusApi\Context;

interface ContextInterface
{
    /**
     * @param array $options
     *
     * @return bool
     */
    public function setOptions(array $options): bool;

    /**
     * @param array $parameters
     *
     * @return bool
     */
    public function setParameters(array $parameters): bool;

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * @return resource
     */
    public function getContext();
}
