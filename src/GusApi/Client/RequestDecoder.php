<?php

namespace GusApi\Client;

class RequestDecoder
{
    /**
     * @param string $response
     *
     * @return string
     */
    public static function decode(string $response): string
    {
        return stristr(stristr($response, '<s:'), '</s:Envelope>', true).'</s:Envelope>';
    }
}
