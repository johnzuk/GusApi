<?php

declare(strict_types=1);

namespace GusApi;

interface RegonConstantsInterface
{
    public const BASE_WSDL_URL_TEST = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-test.wsdl';
    public const BASE_WSDL_ADDRESS_TEST = 'https://Wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';

    public const BASE_WSDL_URL = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-prod.wsdl';
    public const BASE_WSDL_ADDRESS = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';

    public const SERVICE_UNAVAILABLE = 0;
    public const SERVICE_AVAILABLE = 1;
    public const SERVICE_TECHNICAL_BREAK = 2;

    public const NEED_TO_CHECK_CAPTCHA = 1;
    public const TO_FEW_IDENTIFIERS = 2;
    public const NOT_FOUND = 4;
    public const NO_ACCESS_TO_REPORT = 5;
    public const SESSION_ERROR = 7;
}
