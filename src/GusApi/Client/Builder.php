<?php

declare(strict_types=1);

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

final class Builder implements BuilderInterface
{
    public function __construct(private string $environment, private ?GusApiClient $gusApiClient = null)
    {
    }

    /**
     * @throws SoapFault
     */
    public function build(): GusApiClient
    {
        if (null !== $this->gusApiClient) {
            return $this->gusApiClient;
        }

        $env = EnvironmentFactory::create($this->environment);
        $context = new Context();

        $options = [
            'soap_version' => \SOAP_1_2,
            'trace' => true,
            'style' => \SOAP_DOCUMENT,
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
