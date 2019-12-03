<?php

namespace GusApi\Util;

use GusApi\Exception\InvalidServerResponseException;
use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetFullReportResponseRaw;
use SimpleXMLElement;

class FullReportResponseDecoder
{
    /**
     * @throws InvalidServerResponseException
     */
    public static function decode(GetFullReportResponseRaw $fullReportResponseRaw): GetFullReportResponse
    {
        $elements = [];

        if ('' === $fullReportResponseRaw->getDanePobierzPelnyRaportResult()) {
            return new GetFullReportResponse($elements);
        }

        try {
            $xmlElementsResponse = new SimpleXMLElement($fullReportResponseRaw->getDanePobierzPelnyRaportResult());

            foreach ($xmlElementsResponse->dane as $resultData) {
                $element = [];
                foreach ($resultData as $key => $item) {
                    $element[$key] = (string) $item;
                }
                $elements[] = $element;
            }

            return new GetFullReportResponse($elements);
        } catch (\Exception $e) {
            throw new InvalidServerResponseException('Invalid server response');
        }
    }
}
