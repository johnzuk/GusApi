<?php

declare(strict_types=1);

namespace GusApi\Tests\Client;

use GusApi\Client\MultipartResponseDecoder;
use GusApi\Tests\GetContentTrait;
use PHPUnit\Framework\TestCase;

final class RequestDecoderTest extends TestCase
{
    use GetContentTrait;

    public function testDecodeRawRandomString(): void
    {
        $result = MultipartResponseDecoder::decode('test string');
        $this->assertEquals('</s:Envelope>', $result);
    }

    public function testDecodeValidSOAPResponse(): void
    {
        $content = self::getContent(__DIR__ . '/../resources/validSOAPResponse.xsd');

        $result = MultipartResponseDecoder::decode($content);
        $this->assertEquals(trim($content), $result);
    }

    public function testDecodeRawSOAPResponse(): void
    {
        $content = self::getContent(__DIR__ . '/../resources/rawSOAPResponse.xsd');
        $valid = self::getContent(__DIR__ . '/../resources/validSOAPResponse.xsd');

        $result = MultipartResponseDecoder::decode($content);
        $this->assertEquals(trim($valid), $result);
    }

    public function testDecodeRawEnvelopeString(): void
    {
        $result = MultipartResponseDecoder::decode('<s:Envelope>Test</s:Envelope>');
        $this->assertEquals('<s:Envelope>Test</s:Envelope>', $result);
    }
}
