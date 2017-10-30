<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.10.17
 * Time: 13:16
 */

class SoapAdapterTest extends PHPUnit_Framework_TestCase
{
    public function testLogin()
    {
        $key = 'abcde12345abcde12345';

        $gus = new \GusApi\Adapter\Soap\SoapAdapter(
            \GusApi\RegonConstantsInterface::BASE_WSDL_URL_TEST,
            \GusApi\RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
        );
    }
}