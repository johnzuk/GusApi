<?php

namespace GusApi\Environment;

class ProdEnvironment implements EnvironmentInterface
{
    /**
     * @return string
     */
    public function getWSDLUrl(): string
    {
        return 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd';
    }

    /**
     * @return string
     */
    public function getServerLocationUrl(): string
    {
        return 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    }
}
