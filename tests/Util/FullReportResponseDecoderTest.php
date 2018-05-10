<?php

namespace GusApi\Tests\Util;

use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetFullReportResponseRaw;
use GusApi\Util\FullReportResponseDecoder;
use PHPUnit\Framework\TestCase;

class FullReportResponseDecoderTest extends TestCase
{
    public function testDecodeWithEmptyString()
    {
        $rawReport = new GetFullReportResponseRaw('');
        $reportDecoded = FullReportResponseDecoder::decode($rawReport);

        $this->assertInstanceOf(GetFullReportResponse::class, $reportDecoded);
        $this->assertEquals(new \SimpleXMLElement('<data></data>'), $reportDecoded->getReport());
    }

    public function testDecodeWithValidXMLObject()
    {
        $content = file_get_contents(__DIR__.'/../resources/response/fullSearchResponse.xsd');
        $rawReport = new GetFullReportResponseRaw('<result>'.$content.'</result>');
        $reportDecoded = FullReportResponseDecoder::decode($rawReport);

        $this->assertInstanceOf(GetFullReportResponse::class, $reportDecoded);
        $this->assertEquals(new \SimpleXMLElement($content), $reportDecoded->getReport());
    }

    /**
     * @expectedException \GusApi\Exception\InvalidServerResponseException
     */
    public function testInvalidServerResponse()
    {
        $rawReport = new GetFullReportResponseRaw('Invalid XML structure');
        FullReportResponseDecoder::decode($rawReport);
    }
}
