<?php
namespace GusApi\Client;

use GusApi\Adapter\Soap\Exception\NoDataException;
use GusApi\Type\DanePobierzPelnyRaport;
use GusApi\Type\DaneSzukaj;
use GusApi\Type\DaneSzukajResponse;
use GusApi\Type\DaneSzukajResponseRaw;
use GusApi\Type\GetValue;
use GusApi\Type\GetValueResponse;
use GusApi\Type\Wyloguj;
use GusApi\Type\WylogujResponse;
use GusApi\Type\Zaloguj;
use GusApi\Type\ZalogujResponse;
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
     * @param Zaloguj $zaloguj
     * @return ZalogujResponse
     */
    public function Zaloguj(Zaloguj $zaloguj): ZalogujResponse
    {
        return $this->call('Zaloguj', [
            $zaloguj
        ]);
    }

    /**
     * @param Wyloguj $wyloguj
     * @return WylogujResponse
     */
    public function Wyloguj(Wyloguj $wyloguj): WylogujResponse
    {
        return $this->call('Wyloguj', [
            $wyloguj
        ]);
    }

    /**
     * @param GetValue $getValue
     * @param null|string $sid
     * @return GetValueResponse
     */
    public function GetValue(GetValue $getValue, ?string $sid = null): GetValueResponse
    {
        return $this->call('GetValue', [
            $getValue
        ], $sid);
    }

    /**
     * @param DaneSzukaj $daneSzukaj
     * @param string $sid
     * @return DaneSzukajResponse
     * @throws NoDataException
     */
    public function DaneSzukaj(DaneSzukaj $daneSzukaj, string $sid): DaneSzukajResponse
    {
        /**
         * @var DaneSzukajResponseRaw $result
         */
        $result = $this->call('DaneSzukaj', [
            $daneSzukaj
        ], $sid);
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
