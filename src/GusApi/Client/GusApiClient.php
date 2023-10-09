<?php

declare(strict_types=1);

namespace GusApi\Client;

use GusApi\Context\ContextInterface;
use GusApi\Exception\NotFoundException;
use GusApi\Type\Request\GetBulkReport;
use GusApi\Type\Request\GetFullReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\RequestInterface;
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
    public const ADDRESSING_NAMESPACE = 'http://www.w3.org/2005/08/addressing';

    public function __construct(private \SoapClient $soapClient, private string $location, private ContextInterface $streamContext)
    {
    }

    public function login(Login $login): LoginResponse
    {
        return $this->call('Zaloguj', $login);
    }

    public function logout(Logout $logout): LogoutResponse
    {
        return $this->call('Wyloguj', $logout);
    }

    public function getValue(GetValue $getValue, ?string $sessionId = null): GetValueResponse
    {
        return $this->call('GetValue', $getValue, $sessionId);
    }

    /**
     * @throws NotFoundException
     */
    public function searchData(SearchData $searchData, string $sessionId): SearchDataResponse
    {
        /**
         * @var SearchResponseRaw $result
         */
        $result = $this->call('DaneSzukajPodmioty', $searchData, $sessionId);

        if ('' === $result->getDaneSzukajPodmiotyResult()) {
            throw new NotFoundException('No data found');
        }

        return DataSearchDecoder::decode($result);
    }

    public function getFullReport(GetFullReport $getFullReport, string $sessionId): GetFullReportResponse
    {
        $rawResponse = $this->call('DanePobierzPelnyRaport', $getFullReport, $sessionId);

        return FullReportResponseDecoder::decode($rawResponse);
    }

    public function getBulkReport(GetBulkReport $getBulkReport, string $sessionId): array
    {
        $rawResponse = $this->call('DanePobierzRaportZbiorczy', $getBulkReport, $sessionId);

        return BulkReportResponseDecoder::decode($rawResponse);
    }

    private function setHttpOptions(array $options): void
    {
        $this->streamContext->setOptions([
            'http' => $options,
        ]);
    }

    private function call(string $functionName, RequestInterface $request, ?string $sid = null)
    {
        $action = SoapActionMapper::getAction($functionName);
        $soapHeaders = $this->getRequestHeaders($action, $this->location);
        $this->soapClient->__setLocation($this->location);
        $this->setHttpOptions([
            'header' => 'sid: ' . $sid,
            'user_agent' => 'PHP GusApi',
        ]);

        return $this->soapClient->__soapCall($functionName, [$request->toArray()], [], $soapHeaders);
    }

    /**
     * @return \SoapHeader[]
     */
    private function getRequestHeaders(string $action, string $to): array
    {
        return [
            new \SoapHeader(self::ADDRESSING_NAMESPACE, 'Action', $action),
            new \SoapHeader(self::ADDRESSING_NAMESPACE, 'To', $to),
        ];
    }

    public function getSoapClient(): \SoapClient
    {
        return $this->soapClient;
    }
}
