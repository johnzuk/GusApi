<?php

declare(strict_types=1);

namespace GusApi\Client;

class SoapClient extends \SoapClient
{
    public function __doRequest(string $request, string $location, string $action, int $version, bool $oneWay = false): string
    {
        $response = parent::__doRequest($request, $location, $action, $version, $oneWay);

        return MultipartResponseDecoder::decode((string) $response);
    }
}
