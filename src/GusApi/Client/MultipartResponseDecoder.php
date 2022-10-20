<?php

declare(strict_types=1);

namespace GusApi\Client;

class MultipartResponseDecoder
{
    public static function decode(string $response): string
    {
        return stristr((string) stristr($response, '<s:'), '</s:Envelope>', true) . '</s:Envelope>';
    }
}
