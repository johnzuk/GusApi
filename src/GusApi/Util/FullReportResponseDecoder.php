<?php

namespace GusApi\Util;

use GusApi\Exception\InvalidServerResponseException;
use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetFullReportResponseRaw;

class FullReportResponseDecoder
{
    /**
     * @param GetFullReportResponseRaw $fullReportResponseRaw
     *
     * @throws InvalidServerResponseException
     *
     * @return GetFullReportResponse
     */
    public static function decode(GetFullReportResponseRaw $fullReportResponseRaw): GetFullReportResponse
    {
        if ('' === $fullReportResponseRaw->getDanePobierzPelnyRaportResult()) {
            return new GetFullReportResponse(new \SimpleXMLElement('<data></data>'));
        }

        try {
            $xmlElementsResponse = new \SimpleXMLElement($fullReportResponseRaw->getDanePobierzPelnyRaportResult());
            return new GetFullReportResponse($xmlElementsResponse->dane);
        } catch (\Exception $e) {
            throw new InvalidServerResponseException('Invalid server response');
        }
    }
}
