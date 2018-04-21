<?php

namespace GusApi\Environment;

/**
 * Class DevEnvironment
 *
 * @package GusApi\Environment
 */
class DevEnvironment implements EnvironmentInterface
{
    public function getWSDLUrl(): string
    {
        return 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd';
    }

    public function getServerLocationUrl(): string
    {
        return 'https://Wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    }
}
