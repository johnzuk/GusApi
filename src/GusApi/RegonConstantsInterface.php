<?php

namespace GusApi;

interface RegonConstantsInterface
{
    const BASE_WSDL_URL_TEST = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-test.wsdl';
    const BASE_WSDL_ADDRESS_TEST = 'https://Wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';

    const BASE_WSDL_URL = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl-ver11-prod.wsdl';
    const BASE_WSDL_ADDRESS = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';

    const SERVICE_UNAVAILABLE = 0;
    const SERVICE_AVAILABLE = 1;
    const SERVICE_TECHNICAL_BREAK = 2;

    const NEED_TO_CHECK_CAPTCHA = 1;
    const TO_FEW_IDENTIFIERS = 2;
    const NOT_FOUND = 4;
    const NO_ACCESS_TO_REPORT = 5;
    const SESSION_ERROR = 7;
}
