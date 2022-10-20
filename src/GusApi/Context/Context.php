<?php

declare(strict_types=1);

namespace GusApi\Context;

final class Context implements ContextInterface
{
    /**
     * @var resource
     */
    private $context;

    public function __construct()
    {
        $this->context = stream_context_create();
    }

    public function setOptions(array $options): bool
    {
        return stream_context_set_option($this->context, $options);
    }

    public function setParameters(array $parameters): bool
    {
        return stream_context_set_params($this->context, $parameters);
    }

    public function getOptions(): array
    {
        return stream_context_get_options($this->context);
    }

    public function getParameters(): array
    {
        return stream_context_get_params($this->context);
    }

    public function getContext()
    {
        return $this->context;
    }
}
