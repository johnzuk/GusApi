<?php

namespace GusApi\Util;

use GusApi\Exception\InvalidServerResponseException;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\Response\SearchResponseRaw;

class DataSearchDecoder
{
    /**
     * @param SearchResponseRaw $searchResponseRaw
     *
     * @throws InvalidServerResponseException
     *
     * @return SearchDataResponse
     */
    public static function decode(SearchResponseRaw $searchResponseRaw): SearchDataResponse
    {
        $elements = [];

        if ('' === $searchResponseRaw->getDaneSzukajResult()) {
            return new SearchDataResponse();
        }

        try {
            $xmlElementsResponse = new \SimpleXMLElement($searchResponseRaw->getDaneSzukajResult());

            foreach ($xmlElementsResponse->dane as $resultData) {
                $element = new SearchResponseCompanyData();
                foreach ($resultData as $key => $item) {
                    $element->$key = (string) $item;
                }
                $elements[] = $element;
            }

            return new SearchDataResponse($elements);
        } catch (\Exception $e) {
            throw new InvalidServerResponseException('Invalid server response');
        }
    }
}
