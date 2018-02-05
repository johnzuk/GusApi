<?php
namespace GusApi\Client;

class RequestDecoderTest extends \PHPUnit_Framework_TestCase
{
    public function testDecodeRawRandomString()
    {
        $result = RequestDecoder::decode('test string');
        $this->assertEquals('</s:Envelope>', $result);
    }

    public function testDecodeValidSOAPResponse()
    {
        $content = file_get_contents(__DIR__.'/../resources/validSOAPResponse.xsd');

        $result = RequestDecoder::decode($content);
        $this->assertEquals(trim($content), $result);
    }

    public function testDecodeRawSOAPResponse()
    {
        $content = file_get_contents(__DIR__.'/../resources/rawSOAPResponse.xsd');
        $valid = file_get_contents(__DIR__.'/../resources/validSOAPResponse.xsd');

        $result = RequestDecoder::decode($content);
        $this->assertEquals(trim($valid), $result);
    }
}
