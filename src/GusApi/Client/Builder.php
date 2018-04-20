<?php
namespace GusApi\Client;

use GusApi\Context\Context;
use GusApi\Environment\EnvironmentFactory;

/**
 * Class Builder
 * @package GusApi\Client
 */
class Builder implements BuilderInterface
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * Builder constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return GusApiClient
     */
    public function build(): GusApiClient
    {
        $env = EnvironmentFactory::create($this->environment);
        $context = new Context();

        $options = [
            'soap_version' => SOAP_1_2,
            'trace' => true,
            'style' => SOAP_DOCUMENT,
            'stream_context' => $context->getContext(),
            'classmap' => [
                'ZalogujResponse' => \GusApi\Type\LoginResponse::class,
                'WylogujResponse' => \GusApi\Type\LogoutResponse::class,
                'GetValueResponse' => \GusApi\Type\GetValueResponse::class,
                'DaneSzukajResponse' => \GusApi\Type\SearchResponseRaw::class,
                'DanePobierzPelnyRaportResponse' => \GusApi\Type\GetFullReportResponseRaw::class
            ]
        ];

        $soap = new SoapClient(
            $env->getWSDLUrl(),
            $options
        );

        return new GusApiClient($soap, $env->getServerLocationUrl(), $context);
    }
}
