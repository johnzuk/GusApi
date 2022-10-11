<?php

declare(strict_types=1);

namespace GusApi\Tests\Context;

use GusApi\Context\Context;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
    /**
     * @var Context
     */
    protected $context;

    protected function setUp(): void
    {
        $this->context = new Context();
    }

    public function testSetOptions()
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

    public function testSetParameters()
    {
        $params = [
            'notification' => function () {
                return true;
            },
            'options' => [],
        ];

        $this->context->setParameters($params);
        $this->assertSame($params, $this->context->getParameters());
        $this->assertSame($params, stream_context_get_params($this->context->getContext()));
    }
}
