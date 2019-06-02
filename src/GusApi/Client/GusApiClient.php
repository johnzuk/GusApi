<?php

namespace GusApi\Client;

use GusApi\Context\ContextInterface;
use GusApi\Exception\NotFoundException;
use GusApi\Type\Request\GetBulkReport;
use GusApi\Type\Request\GetFullReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\SearchData;
use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetValueResponse;
use GusApi\Type\Response\LoginResponse;
use GusApi\Type\Response\LogoutResponse;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseRaw;
use GusApi\Util\BulkReportResponseDecoder;
use GusApi\Util\DataSearchDecoder;
use GusApi\Util\FullReportResponseDecoder;

class GusApiClient
{
    const ADDRESSING_NAMESPACE = 'http://www.w3.org/2005/08/addressing';

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
     *
     * @param \SoapClient      $soapClient
     * @param string           $location
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
     *
     * @return LoginResponse
     */
    public function login(Login $login): LoginResponse
    {
        return $this->call('Zaloguj', [
            $login,
        ]);
    }

    /**
     * @param Logout $logout
     *
     * @return LogoutResponse
     */
    public function logout(Logout $logout): LogoutResponse
    {
        return $this->call('Wyloguj', [
            $logout,
        ]);
    }

    /**
     * @param GetValue    $getValue
     * @param null|string $sessionId
     *
     * @return GetValueResponse
     */
    public function getValue(GetValue $getValue, ?string $sessionId = null): GetValueResponse
    {
        return $this->call('GetValue', [
            $getValue,
        ], $sessionId);
    }

    /**
     * @param SearchData $searchData
     * @param string     $sessionId
     *
     * @throws NotFoundException
     *
     * @return SearchDataResponse
     */
    public function searchData(SearchData $searchData, string $sessionId): SearchDataResponse
    {
        /**
         * @var SearchResponseRaw
         */
        $result = $this->call('DaneSzukajPodmioty', [
            $searchData,
        ], $sessionId);

        if ('' === $result->getDaneSzukajPodmiotyResult()) {
            throw new NotFoundException('No data found');
        }

        return DataSearchDecoder::decode($result);
    }

    /**
     * @param GetFullReport $getFullReport
     * @param string        $sessionId
     *
     * @return GetFullReportResponse
     */
    public function getFullReport(GetFullReport $getFullReport, string $sessionId): GetFullReportResponse
    {
        $rawResponse = $this->call('DanePobierzPelnyRaport', [
            $getFullReport,
        ], $sessionId);

        return FullReportResponseDecoder::decode($rawResponse);
    }

    /**
     * @param GetBulkReport $getBulkReport
     * @param string        $sessionId
     *
     * @return array
     */
    public function getBulkReport(GetBulkReport $getBulkReport, string $sessionId): array
    {
        $rawResponse = $this->call('DanePobierzRaportZbiorczy', [
            $getBulkReport,
        ], $sessionId);

        return BulkReportResponseDecoder::decode($rawResponse);
    }

    /**
     * @param array $options
     */
    public function setHttpOptions(array $options): void
    {
        $this->streamContext->setOptions([
            'http' => $options,
        ]);
    }

    protected function call(string $functionName, $arguments, ?string $sid = null)
    {
        $action = SoapActionMapper::getAction($functionName);
        $soapHeaders = $this->getRequestHeaders($action, $this->location);
        $this->setHttpOptions([
            'header' => 'sid: '.$sid,
            'user_agent' => 'PHP GusApi',
        ]);

        return $this->soapClient->__soapCall($functionName, $arguments, [], $soapHeaders);
    }

    /**
     * @param string $action
     * @param string $to
     *
     * @return \SoapHeader[]
     */
    protected function getRequestHeaders(string $action, string $to): array
    {
        return [
            new \SoapHeader(self::ADDRESSING_NAMESPACE, 'Action', $action),
            new \SoapHeader(self::ADDRESSING_NAMESPACE, 'To', $to),
        ];
    }
}
