<?php

declare(strict_types=1);

namespace GusApi\Environment;

final class DevEnvironment implements EnvironmentInterface
{
    public function getWSDLUrl(): string
    {
        return 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-test.wsdl';
    }

    public function getServerLocationUrl(): string
    {
        return 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    }
}
