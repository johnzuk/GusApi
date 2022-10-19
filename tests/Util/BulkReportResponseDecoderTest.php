<?php

declare(strict_types=1);

namespace GusApi\Tests\Util;

use GusApi\Exception\InvalidServerResponseException;
use GusApi\Tests\GetContentTrait;
use GusApi\Type\Response\GetBulkReportResponseRaw;
use GusApi\Util\BulkReportResponseDecoder;
use PHPUnit\Framework\TestCase;

class BulkReportResponseDecoderTest extends TestCase
{
    use GetContentTrait;

    public function testDecode(): void
    {
        $content = self::getContent(__DIR__ . '/../resources/response/bulkReportResponse.xsd');
        $rawResponse = new GetBulkReportResponseRaw($content);
        $decodedResponse = BulkReportResponseDecoder::decode($rawResponse);

        $expected = [
            '022399999',
            '147210456',
            '243544401',
            '341568222',
        ];
        $this->assertEquals($expected, $decodedResponse);
    }

    public function testDecodeWithInvalidStringStructure(): void
    {
        $this->expectException(InvalidServerResponseException::class);
        $content = 'Invalid XML structure';
        $rawResponse = new GetBulkReportResponseRaw($content);
        BulkReportResponseDecoder::decode($rawResponse);
    }

    public function testDecodeEmptyServerResponse(): void
    {
        $rawResponse = new GetBulkReportResponseRaw('');
        $decodedResponse = BulkReportResponseDecoder::decode($rawResponse);

        $this->assertEquals([], $decodedResponse);
    }
}
