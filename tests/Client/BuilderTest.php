<?php

declare(strict_types=1);

namespace GusApi\Tests\Client;

use GusApi\Client\Builder;
use GusApi\Client\GusApiClient;
use GusApi\Client\SoapClient;
use GusApi\Context\Context;
use GusApi\Exception\InvalidEnvironmentNameException;
use PHPUnit\Framework\TestCase;

final class BuilderTest extends TestCase
{
    public function testBuildWithInvalidEnvironmentName(): void
    {
        $builder = new Builder('random');
        $this->expectException(InvalidEnvironmentNameException::class);
        $builder->build();
    }

    public function testBuildWithApiClient(): void
    {
        $options = [
            'soap_version' => \SOAP_1_1,
        ];
        $client = new GusApiClient(
            new SoapClient(__DIR__ . '/../UslugaBIRzewnPubl.xsd', $options),
            'Location',
            new Context()
        );
        $builder = new Builder('dev', $client);

        $this->assertSame($client, $builder->build());
    }
}
