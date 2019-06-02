<?php

namespace GusApi\Client;

use GusApi\Context\Context;
use GusApi\Environment\EnvironmentFactory;
use GusApi\Type\Response\GetBulkReportResponseRaw;
use GusApi\Type\Response\GetFullReportResponseRaw;
use GusApi\Type\Response\GetValueResponse;
use GusApi\Type\Response\LoginResponse;
use GusApi\Type\Response\LogoutResponse;
use GusApi\Type\Response\SearchResponseRaw;
use SoapFault;

class Builder implements BuilderInterface
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var GusApiClient|null
     */
    protected $gusApiClient;

    /**
     * Builder constructor.
     *
     * @param string            $environment
     * @param GusApiClient|null $gusApiClient
     */
    public function __construct(string $environment, ?GusApiClient $gusApiClient = null)
    {
        $this->environment = $environment;
        $this->gusApiClient = $gusApiClient;
    }

    /**
     * @throws SoapFault
     *
     * @return GusApiClient
     */
    public function build(): GusApiClient
    {
        if (null !== $this->gusApiClient) {
            return $this->gusApiClient;
        }

        $env = EnvironmentFactory::create($this->environment);
        $context = new Context();

        $options = [
            'soap_version' => SOAP_1_2,
            'trace' => true,
            'style' => SOAP_DOCUMENT,
            'stream_context' => $context->getContext(),
            'classmap' => [
                'ZalogujResponse' => LoginResponse::class,
                'WylogujResponse' => LogoutResponse::class,
                'GetValueResponse' => GetValueResponse::class,
                'DaneSzukajPodmiotyResponse' => SearchResponseRaw::class,
                'DanePobierzPelnyRaportResponse' => GetFullReportResponseRaw::class,
                'DanePobierzRaportZbiorczyResponse' => GetBulkReportResponseRaw::class,
            ],
        ];

        $soap = new SoapClient(
            $env->getWSDLUrl(),
            $options
        );

        return new GusApiClient($soap, $env->getServerLocationUrl(), $context);
    }
}
