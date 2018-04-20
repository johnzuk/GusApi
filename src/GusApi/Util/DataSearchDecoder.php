<?php
namespace GusApi\Util;

use GusApi\Type\SearchDataResponse;
use GusApi\Type\SearchResponseCompanyData;
use GusApi\Type\SearchResponseRaw;

/**
 * Class DataSearchDecoder
 * @package GusApi\Util
 */
class DataSearchDecoder
{
    /**
     * @param SearchResponseRaw $searchResponseRaw
     * @return SearchDataResponse
     */
    public static function decode(SearchResponseRaw $searchResponseRaw): SearchDataResponse
    {
        $elements = [];
        $xmlElementsResponse = new \SimpleXMLElement($searchResponseRaw->getDaneSzukajResult());

        foreach ($xmlElementsResponse->dane as $resultData) {
            $element = new SearchResponseCompanyData();
            foreach ($resultData as $key => $item) {
                $element->$key = (string)$item;
            }
            $elements[] = $element;
        }

        return new SearchDataResponse($elements);
    }
}
