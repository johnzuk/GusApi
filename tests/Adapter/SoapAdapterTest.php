<?php

namespace GusApi\Tests\Adapter;

use GusApi\Adapter\Soap\SoapAdapter;
use GusApi\RegonConstantsInterface;
use PHPUnit\Framework\TestCase;

class SoapAdapterTest extends TestCase
{
    public function testLogin()
    {
        $key = 'abcde12345abcde12345';

        $gus = new SoapAdapter(
            RegonConstantsInterface::BASE_WSDL_URL_TEST,
            RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
        );

        $this->assertInternalType('string', $gus->login($key));
    }
}
