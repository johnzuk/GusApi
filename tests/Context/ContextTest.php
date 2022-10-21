<?php

declare(strict_types=1);

namespace GusApi\Tests\Context;

use GusApi\Context\Context;
use PHPUnit\Framework\TestCase;

final class ContextTest extends TestCase
{
    private Context $context;

    protected function setUp(): void
    {
        $this->context = new Context();
    }

    public function testSetOptions(): void
    {
        $options = [
            'http' => [
                'follow_location' => false,
            ],
        ];

        $this->context->setOptions($options);
        $this->assertSame($options, $this->context->getOptions());
        $this->assertSame($options, stream_context_get_options($this->context->getContext()));
    }

    public function testSetParameters(): void
    {
        $params = [
            'notification' => fn () => true,
            'options' => [],
        ];

        $this->context->setParameters($params);
        $this->assertSame($params, $this->context->getParameters());
        $this->assertSame($params, stream_context_get_params($this->context->getContext()));
    }
}
