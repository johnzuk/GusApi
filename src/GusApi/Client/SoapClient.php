<?php

namespace GusApi\Client;

class SoapClient extends \SoapClient
{
    public function __doRequest($request, $location, $action, $version, $one_way = 0): string
    {
        $response = parent::__doRequest($request, $location, $action, $version, $one_way);

        return MultipartResponseDecoder::decode($response);
    }
}
