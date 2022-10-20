<?php

declare(strict_types=1);

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
        /** @var array<int, array<string, string>> $elements */
        $elements = [];

        if ('' === $fullReportResponseRaw->getDanePobierzPelnyRaportResult()) {
            return new GetFullReportResponse($elements);
        }

        try {
            $xmlElementsResponse = new SimpleXMLElement($fullReportResponseRaw->getDanePobierzPelnyRaportResult());

            foreach ($xmlElementsResponse->dane as $resultData) {
                /** @var array<string, string> $element */
                $element = [];
                foreach ($resultData as $key => $item) {
                    $element[$key] = (string) $item;
                }
                $elements[] = $element;
            }

            return new GetFullReportResponse($elements);
        } catch (\Exception $e) {
            throw new InvalidServerResponseException('Invalid server response', 0, $e);
        }
    }
}
