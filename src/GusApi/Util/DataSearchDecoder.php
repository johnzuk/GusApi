<?php

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
            throw new InvalidServerResponseException('Invalid server response');
        }

        $elements = [];

        foreach ($xmlElementsResponse->dane as $resultData) {
            $elements[] = static::decodeSingleResult($resultData);
        }

        return new SearchDataResponse($elements);
    }

    /**
     * @throws NotFoundException
     */
    protected static function decodeSingleResult(SimpleXMLElement $element): SearchResponseCompanyData
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
