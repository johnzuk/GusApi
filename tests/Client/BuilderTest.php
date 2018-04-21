<?php
namespace GusApi\Client;

use GusApi\Context\Context;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @dataProvider envProvider
     */
    public function testBuildWithValidEnvironmentName($env)
    {
        $builder = new Builder($env);
        $client = $builder->build();

        $this->assertInstanceOf(GusApiClient::class, $client);
    }

    /**
     * @expectedException \GusApi\Exception\InvalidEnvironmentNameException
     */
    public function testBuildWithInvalidEnvironmentName()
    {
        $builder = new Builder('random');
        $client = $builder->build();
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

        $this->assertEquals($client, $builder->build());
    }

    public function envProvider()
    {
        return [
            ['prod'],
            ['dev']
        ];
    }
}
