<?php

namespace GusApi\Client;

class SoapClient extends \SoapClient
{
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        $response = parent::__doRequest($request, $location, $action, $version, $one_way);

        return RequestDecoder::decode($response);
    }
}
