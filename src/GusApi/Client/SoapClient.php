<?php

namespace GusApi\Client;

class SoapClient extends \SoapClient
{
    public function __doRequest($request, $location, $action, $version, $oneWay = false): string
    {
        $response = parent::__doRequest($request, $location, $action, $version, $oneWay);
        if (null === $response) {
            return $this->__doRequest($request, $location, $action, $version, $oneWay);
        }

        return MultipartResponseDecoder::decode($response);
    }
}
