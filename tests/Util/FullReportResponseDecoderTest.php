<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 20.04.18
 * Time: 19:18
 */

namespace GusApi\Util;

use GusApi\Type\GetFullReportResponse;
use GusApi\Type\GetFullReportResponseRaw;
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
}
