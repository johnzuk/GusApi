<?php

declare(strict_types=1);

namespace GusApi\Tests\Environment;

use GusApi\Environment\DevEnvironment;
use GusApi\Environment\EnvironmentFactory;
use GusApi\Environment\ProdEnvironment;
use GusApi\Exception\InvalidEnvironmentNameException;
use PHPUnit\Framework\TestCase;

final class EnvironmentFactoryTest extends TestCase
{
    public function testCreateWillCreateProdEnvironment(): void
    {
        self::assertInstanceOf(ProdEnvironment::class, EnvironmentFactory::create('prod'));
    }

    public function testCreateWillCreateDevEnvironment(): void
    {
        self::assertInstanceOf(DevEnvironment::class, EnvironmentFactory::create('dev'));
    }

    public function testCreateWillThworExceptionWhenUndefinedEnvironmentProvided(): void
    {
        $this->expectException(InvalidEnvironmentNameException::class);
        EnvironmentFactory::create('asdf');
    }
}
