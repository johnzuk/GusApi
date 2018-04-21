<?php
namespace GusApi\Client;

use GusApi\Context\ContextInterface;
use GusApi\Exception\NotFoundException;
use GusApi\RegonConstantsInterface;
use GusApi\Type\GetFullReport;
use GusApi\Type\GetFullReportResponse;
use GusApi\Type\SearchData;
use GusApi\Type\SearchDataResponse;
use GusApi\Type\SearchResponseRaw;
use GusApi\Type\GetValue;
use GusApi\Type\GetValueResponse;
use GusApi\Type\Logout;
use GusApi\Type\LogoutResponse;
use GusApi\Type\Login;
use GusApi\Type\LoginResponse;
use GusApi\Util\DataSearchDecoder;
use GusApi\Util\FullReportResponseDecoder;

/**
 * Class GusApiClient
 * @package GusApi\Client
 */
class GusApiClient
{
    /**
     * @var \SoapClient
     */
    protected $soapClient;

    /**
     * @var ContextInterface
     */
    protected $streamContext;

    /**
     * @var string
     */
    protected $location;

    /**
     * GusApiClient constructor.
     * @param \SoapClient $soapClient
     * @param string $location
     * @param ContextInterface $streamContext
     */
    public function __construct(\SoapClient $soapClient, string $location, ContextInterface $streamContext)
    {
        $this->soapClient = $soapClient;
        $this->streamContext = $streamContext;
        $this->setLocation($location);
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
        $this->soapClient->__setLocation($location);
    }

    /**
     * @return \SoapClient
     */
    public function getSoapClient(): \SoapClient
    {
        return $this->soapClient;
    }

    /**
     * @param \SoapClient $soapClient
     */
    public function setSoapClient(\SoapClient $soapClient): void
    {
        $this->soapClient = $soapClient;
    }

    /**
     * @return ContextInterface
     */
    public function getStreamContext(): ContextInterface
    {
        return $this->streamContext;
    }

    /**
     * @param ContextInterface $streamContext
     */
    public function setStreamContext(ContextInterface $streamContext): void
    {
        $this->streamContext = $streamContext;
    }

    /**
     * @param Login $login
     * @return LoginResponse
     */
    public function login(Login $login): LoginResponse
    {
        return $this->call('Zaloguj', [
            $login
        ]);
    }

    /**
     * @param Logout $logout
     * @return LogoutResponse
     */
    public function logout(Logout $logout): LogoutResponse
    {
        return $this->call('Wyloguj', [
            $logout
        ]);
    }

    /**
     * @param GetValue $getValue
     * @param null|string $sessionId
     * @return GetValueResponse
     */
    public function getValue(GetValue $getValue, ?string $sessionId = null): GetValueResponse
    {
        return $this->call('GetValue', [
            $getValue
        ], $sessionId);
    }

    /**
     * @param SearchData $searchData
     * @param string $sessionId
     * @return SearchDataResponse
     * @throws NotFoundException
     */
    public function searchData(SearchData $searchData, string $sessionId): SearchDataResponse
    {
        /**
         * @var SearchResponseRaw $result
         */
        $result = $this->call('DaneSzukaj', [
            $searchData
        ], $sessionId);

        if ($result->getDaneSzukajResult() === '') {
            throw new NotFoundException('No data found');
        }

        return DataSearchDecoder::decode($result);
    }

    /**
     * @param GetFullReport $getFullReport
     * @param string $sessionId
     * @return GetFullReportResponse
     */
    public function getFullReport(GetFullReport $getFullReport, string $sessionId): GetFullReportResponse
    {
        $rawResponse = $this->call('DanePobierzPelnyRaport', [
            $getFullReport
        ], $sessionId);

        return FullReportResponseDecoder::decode($rawResponse);
    }

    /**
     * @param \SoapHeader[] $headers
     * @return bool
     */
    public function setSoapHeaders(array $headers): bool
    {
        return $this->soapClient->__setSoapHeaders($headers);
    }

    /**
     * @param array $options
     */
    public function setHttpOptions(array $options): void
    {
        $this->streamContext->setOptions([
            'http' => $options
        ]);
    }

    public function call(string $functionName, $arguments, ?string $sid = null)
    {
        $action = SoapActionMapper::getAction($functionName);
        $soapHeaders = self::getRequestHeaders($action, $this->location);
        $this->setHttpOptions([
            'header' => 'sid: '.$sid."\r\n".'User-agent: PHP GusApi',
        ]);

        return $this->soapClient->__soapCall($functionName, $arguments, null, $soapHeaders);
    }

    /**
     * @param string $action
     * @param string $to
     * @return \SoapHeader[]
     */
    public static function getRequestHeaders(string $action, string $to): array
    {
        return [
            new \SoapHeader(RegonConstantsInterface::ADRESING_NAMESPACE, 'Action', $action),
            new \SoapHeader(RegonConstantsInterface::ADRESING_NAMESPACE, 'To', $to)
        ];
    }

    /**
     * Clear soap header
     * @return bool
     */
    public function clearHeader(): bool
    {
        return $this->soapClient->__setSoapHeaders(null);
    }
}
