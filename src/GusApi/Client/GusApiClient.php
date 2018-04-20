<?php
namespace GusApi\Client;

use GusApi\Adapter\Soap\Exception\NoDataException;
use GusApi\Type\DanePobierzPelnyRaport;
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
     * @var resource
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
     * @param resource $streamContext
     */
    public function __construct(\SoapClient $soapClient, string $location, $streamContext)
    {
        $this->soapClient = $soapClient;
        $this->streamContext = $streamContext;
        $this->location = $location;
        $this->setLocation($location);
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
     * @throws NoDataException
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
            throw new NoDataException('No data found');
        }

        return DataSearchDecoder::decode($result);
    }

    public function DanePobierzPelnyRaport(DanePobierzPelnyRaport $danePobierzPelnyRaport, string $sid)
    {
        return $this->call('DanePobierzPelnyRaport', [
            $danePobierzPelnyRaport
        ], $sid);
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->soapClient->__setLocation($location);
    }

    /**
     * @param \SoapHeader[] $headers
     */
    public function setSoapHeaders(array $headers): void
    {
        $this->soapClient->__setSoapHeaders($headers);
    }

    /**
     * @param array $options
     */
    public function setHttpOptions(array $options): void
    {
        $this->setContextOption([
            'http' => $options
        ]);
    }

    protected function call(string $functionName, $arguments, ?string $sid = null)
    {
        $action = SoapActionMapper::getAction($functionName);
        $this->createRequestHeaders($action, $this->location);
        if ($sid !== null) {
            $this->setHttpOptions([
                'header' => 'sid: '.$sid
            ]);
        }

        return $this->soapClient->__soapCall($functionName, $arguments);
    }

    /**
     * @param array $options
     */
    private function setContextOption(array $options): void
    {
        stream_context_set_option($this->streamContext, $options);
    }

    /**
     * @param string $action
     * @param string $to
     */
    protected function createRequestHeaders(string $action, string $to): void
    {
        $this->clearHeader();

        $header[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', $action);
        $header[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'To', $to);
        $this->soapClient->__setSoapHeaders($header);
    }

    /**
     * Clear soap header
     */
    protected function clearHeader(): void
    {
        $this->soapClient->__setSoapHeaders(null);
    }
}
