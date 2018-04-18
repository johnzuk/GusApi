<?php

namespace GusApi;

use GusApi\ClientClient;
use GusApi\ClientClassmap;
use Phpro\SoapClient\ClientFactory as PhproClientFactory;
use Phpro\SoapClient\ClientBuilder;

class ClientClientFactory
{

    public static function factory(string $wsdl) : \GusApi\ClientClient
    {
        $clientFactory = new PhproClientFactory(ClientClient::class);
        $clientBuilder = new ClientBuilder($clientFactory, $wsdl, []);
        $clientBuilder->withClassMaps(ClientClassmap::getCollection());

        return $clientBuilder->build();
    }


}

