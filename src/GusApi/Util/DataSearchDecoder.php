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
     * @param SearchResponseRaw $searchResponseRaw
     *
     * @throws InvalidServerResponseException
     * @throws NotFoundException
     *
     * @return SearchDataResponse
     */
    public static function decode(SearchResponseRaw $searchResponseRaw): SearchDataResponse
    {
        $elements = [];

        if ('' === $searchResponseRaw->getDaneSzukajPodmiotyResult()) {
            return new SearchDataResponse();
        }

        try {
            $xmlElementsResponse = new SimpleXMLElement($searchResponseRaw->getDaneSzukajPodmiotyResult());
        } catch (\Exception $e) {
            throw new InvalidServerResponseException('Invalid server response');
        }

        foreach ($xmlElementsResponse->dane as $resultData) {
            $element = new SearchResponseCompanyData();
            foreach ($resultData as $key => $item) {
                if ($key === 'ErrorCode' && (int) $item === 4) {
                    throw new NotFoundException('No data found');
                }
                $element->$key = (string) $item;
            }
            $elements[] = $element;
        }

        return new SearchDataResponse($elements);
    }
}
