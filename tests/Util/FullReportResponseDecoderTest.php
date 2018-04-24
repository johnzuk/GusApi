<?php

namespace GusApi\Util;

use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetFullReportResponseRaw;
use PHPUnit\Framework\TestCase;

class FullReportResponseDecoderTest extends TestCase
{
    public function testDecodeWithEmptyString()
    {
        $rawReport = new GetFullReportResponseRaw('');
        $reportDecoded = FullReportResponseDecoder::decode($rawReport);
        $expected = new GetFullReportResponse(new \SimpleXMLElement('<data></data>'));

        $this->assertEquals($expected, $reportDecoded);
    }

    public function testDecodeWithValidXMLObject()
    {
        $content = file_get_contents(__DIR__.'/../resources/response/fullSearchResponse.xsd');
        $rawReport = new GetFullReportResponseRaw('<result>'.$content.'</result>');

        $reportDecoded = FullReportResponseDecoder::decode($rawReport);
        $expected = new GetFullReportResponse(new \SimpleXMLElement($content));

        $this->assertEquals($expected, $reportDecoded);
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
