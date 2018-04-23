<?php

namespace GusApi\Util;

use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\Response\SearchResponseRaw;

class DataSearchDecoder
{
    /**
     * @param SearchResponseRaw $searchResponseRaw
     *
     * @return SearchDataResponse
     */
    public static function decode(SearchResponseRaw $searchResponseRaw): SearchDataResponse
    {
        $elements = [];

        if (empty($searchResponseRaw->getDaneSzukajResult())) {
            return new SearchDataResponse($elements);
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
        } catch (\Exception $e) {
        }

        return new SearchDataResponse($elements);
    }
}
