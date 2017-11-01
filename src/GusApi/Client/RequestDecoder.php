<?php
namespace GusApi\Client;

/**
 * Class RequestDecoder
 * @package GusApi\Client
 */
class RequestDecoder
{
    /**
     * @param string $response
     * @return string
     */
    public static function decode($response)
    {
        return stristr(stristr($response, "<s:"), "</s:Envelope>", true) . "</s:Envelope>";
    }
}
