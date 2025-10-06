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
        $environment = EnvironmentFactory::create('prod');

        self::assertInstanceOf(ProdEnvironment::class, $environment);
        self::assertSame(
            'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-prod.wsdl',
            $environment->getWSDLUrl()
        );
        self::assertSame(
            'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc',
            $environment->getServerLocationUrl()
        );
    }

    public function testCreateWillCreateDevEnvironment(): void
    {
        $environment = EnvironmentFactory::create('dev');

        self::assertInstanceOf(DevEnvironment::class, $environment);
        self::assertSame(
            'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-test.wsdl',
            $environment->getWSDLUrl()
        );
        self::assertSame(
            'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc',
            $environment->getServerLocationUrl()
        );
        self::assertInstanceOf(DevEnvironment::class, EnvironmentFactory::create('dev'));
    }

    public function testCreateWillThrowExceptionWhenUndefinedEnvironmentProvided(): void
    {
        $this->expectException(InvalidEnvironmentNameException::class);
        EnvironmentFactory::create('asdf');
    }
}
