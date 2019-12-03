<?php

namespace GusApi\Tests\Client;

use GusApi\Client\MultipartResponseDecoder;
use PHPUnit\Framework\TestCase;

final class RequestDecoderTest extends TestCase
{
    public function testDecodeRawRandomString()
    {
        $result = MultipartResponseDecoder::decode('test string');
        $this->assertEquals('</s:Envelope>', $result);
    }

    public function testDecodeValidSOAPResponse()
    {
        $content = \file_get_contents(__DIR__.'/../resources/validSOAPResponse.xsd');

        $result = MultipartResponseDecoder::decode($content);
        $this->assertEquals(\trim($content), $result);
    }

    public function testDecodeRawSOAPResponse()
    {
        $content = \file_get_contents(__DIR__.'/../resources/rawSOAPResponse.xsd');
        $valid = \file_get_contents(__DIR__.'/../resources/validSOAPResponse.xsd');

        $result = MultipartResponseDecoder::decode($content);
        $this->assertEquals(\trim($valid), $result);
    }

    public function testDecodeRawEnvelopeString()
    {
        $result = MultipartResponseDecoder::decode('<s:Envelope>Test</s:Envelope>');
        $this->assertEquals('<s:Envelope>Test</s:Envelope>', $result);
    }
}
