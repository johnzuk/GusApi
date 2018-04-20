<?php
namespace GusApi\Util;

use GusApi\Type\GetFullReportResponse;
use GusApi\Type\GetFullReportResponseRaw;

class FullReportResponseDecoder
{
    /**
     * @param GetFullReportResponseRaw $fullReportResponseRaw
     * @return GetFullReportResponse
     */
    public static function decode(GetFullReportResponseRaw $fullReportResponseRaw): GetFullReportResponse
    {
        try {
            $xmlElementsResponse = new \SimpleXMLElement($fullReportResponseRaw->getDanePobierzPelnyRaportResult());
            $data = $xmlElementsResponse->dane;
        } catch (\Exception $e) {
            $xmlElementsResponse = new \SimpleXMLElement('');
        }

        return new GetFullReportResponse($data);
    }
}
