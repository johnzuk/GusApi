<?php

namespace GusApi\Client;

class MultipartResponseDecoder
{
    /**
     * @param string $response
     *
     * @return string
     */
    public static function decode(string $response): string
    {
        return \stristr((string) \stristr($response, '<s:'), '</s:Envelope>', true).'</s:Envelope>';
    }
}
