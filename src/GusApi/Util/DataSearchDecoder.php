<?php

declare(strict_types=1);

namespace GusApi\Util;

use GusApi\Exception\InvalidServerResponseException;
use GusApi\Exception\NotFoundException;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\Response\SearchResponseRaw;
use SimpleXMLElement;

class DataSearchDecoder
{
    /**
     * @throws InvalidServerResponseException
     * @throws NotFoundException
     */
    public static function decode(SearchResponseRaw $searchResponseRaw): SearchDataResponse
    {
        if ('' === $searchResponseRaw->getDaneSzukajPodmiotyResult()) {
            return new SearchDataResponse();
        }

        try {
            $xmlElementsResponse = new SimpleXMLElement($searchResponseRaw->getDaneSzukajPodmiotyResult());
        } catch (\Exception $e) {
            throw new InvalidServerResponseException('Invalid server response', 0, $e);
        }

        $elements = [];

        foreach ($xmlElementsResponse->dane as $resultData) {
            $elements[] = self::decodeSingleResult($resultData);
        }

        return new SearchDataResponse($elements);
    }

    /**
     * @throws NotFoundException
     */
    private static function decodeSingleResult(SimpleXMLElement $element): SearchResponseCompanyData
    {
        $result = new SearchResponseCompanyData();

        foreach ($element as $key => $item) {
            if ('ErrorCode' === $key && 4 === (int) $item) {
                throw new NotFoundException('No data found');
            }

            $result->$key = (string) $item;
        }

        return $result;
    }
}
