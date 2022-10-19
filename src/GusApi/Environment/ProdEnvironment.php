<?php

declare(strict_types=1);

namespace GusApi\Environment;

final class ProdEnvironment implements EnvironmentInterface
{
    public function getWSDLUrl(): string
    {
        return 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-prod.wsdl';
    }

    public function getServerLocationUrl(): string
    {
        return 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    }
}
