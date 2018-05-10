<?php

namespace GusApi\Tests\Client;

use GusApi\Client\Builder;
use GusApi\Client\GusApiClient;
use GusApi\Client\SoapClient;
use GusApi\Context\Context;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @dataProvider envProvider
     */
    public function testBuildWithValidEnvironmentName(string $env, string $location)
    {
        $builder = new Builder($env);
        $client = $builder->build();
        $soapClient = $client->getSoapClient();

        $this->assertInstanceOf(GusApiClient::class, $client);
        $this->assertSame($location, $client->getLocation());
        $this->assertAttributeSame(2, '_soap_version', $soapClient);
        $this->assertAttributeInternalType('resource', '_stream_context', $soapClient);
        $this->assertAttributeSame($client->getStreamContext()->getContext(), '_stream_context', $soapClient);
    }

    /**
     * @expectedException \GusApi\Exception\InvalidEnvironmentNameException
     */
    public function testBuildWithInvalidEnvironmentName()
    {
        $builder = new Builder('random');
        $builder->build();
    }

    public function testBuildWithApiClient()
    {
        $options = [
            'soap_version' => SOAP_1_1,
        ];
        $client = new GusApiClient(
            new SoapClient(__DIR__.'/../UslugaBIRzewnPubl.xsd', $options),
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
