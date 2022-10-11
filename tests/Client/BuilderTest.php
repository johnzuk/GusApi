<?php

declare(strict_types=1);

namespace GusApi\Tests\Client;

use GusApi\Client\Builder;
use GusApi\Client\GusApiClient;
use GusApi\Client\SoapClient;
use GusApi\Context\Context;
use GusApi\Exception\InvalidEnvironmentNameException;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @dataProvider envProvider
     */
    public function testBuildWithValidEnvironmentName(string $env, string $location): void
    {
        $builder = new Builder($env);
        $client = $builder->build();
        $soapClient = $client->getSoapClient();

        $this->assertInstanceOf(GusApiClient::class, $client);
        $this->assertSame($location, $client->getLocation());
        $this->assertSame(2, $soapClient->_soap_version);
        $this->assertIsResource($soapClient->_stream_context);
        $this->assertSame($client->getStreamContext()->getContext(), $soapClient->_stream_context);
    }

    public function testBuildWithInvalidEnvironmentName()
    {
        $builder = new Builder('random');
        $this->expectException(InvalidEnvironmentNameException::class);
        $builder->build();
    }

    public function testBuildWithApiClient()
    {
        $options = [
            'soap_version' => SOAP_1_1,
        ];
        $client = new GusApiClient(
            new SoapClient(__DIR__ . '/../UslugaBIRzewnPubl.xsd', $options),
            'Location',
            new Context()
        );
        $builder = new Builder('dev', $client);

        $this->assertSame($client, $builder->build());
    }

    public function envProvider()
    {
        return [
            ['prod', 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc'],
            ['dev', 'https://Wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc'],
        ];
    }
}
