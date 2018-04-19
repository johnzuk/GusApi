<?php
namespace GusApi\Util;

use GusApi\Type\DaneSzukajResponse;
use GusApi\Type\DaneSzukajResponseElement;
use GusApi\Type\DaneSzukajResponseRaw;

/**
 * Class DataSearchDecoder
 * @package GusApi\Util
 */
class DataSearchDecoder
{
    /**
     * @param DaneSzukajResponseRaw $daneSzukajResponseRaw
     * @return DaneSzukajResponse
     */
    public static function decode(DaneSzukajResponseRaw $daneSzukajResponseRaw): DaneSzukajResponse
    {
        $elements = [];
        $xmlElementsResponse = new \SimpleXMLElement($daneSzukajResponseRaw->getDaneSzukajResult());

        foreach ($xmlElementsResponse->dane as $resultData) {
            $element = new DaneSzukajResponseElement();
            foreach ($resultData as $key => $item) {
                $element->$key = (string)$item;
            }
            $elements[] = $element;
        }

        return new DaneSzukajResponse($elements);
    }
}
