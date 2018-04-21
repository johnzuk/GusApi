<?php
namespace GusApi\Adapter\Soap;

use GusApi\Adapter\AdapterInterface;
use GusApi\Adapter\Soap\Exception\NoDataException;
use GusApi\Client\SoapClient;
use GusApi\RegonConstantsInterface;

/**
 * Class SoapAdapter SoapAdapter for
 *
 * @package GusApi\Adapter\Soap
 */
class SoapAdapter implements AdapterInterface
{
    /**
     * @var SoapClient gus soap client
     */
    protected $client;

    /**
     * @var string base url address
     */
    protected $baseUrl;

    /**
     * @var string base address to http header
     */
    protected $address;

    /**
     * Create Gus soap adapter
     *
     * @param string $baseUrl
     * @param string $address
     * @param array  $contextOptions
     */
    public function __construct($baseUrl, $address, array $contextOptions = null)
    {
        $this->baseUrl = $baseUrl;
        $this->address = $address;

        $this->client = new SoapClient(
            $this->baseUrl, $address, [
            'soap_version' => SOAP_1_2,
            'trace' => true,
            'style' => SOAP_DOCUMENT
            ], $contextOptions
        );
    }

    /**
     * @return SoapClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @inheritdoc
     */
    public function login($userKey)
    {
        $this->prepareSoapHeader('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Zaloguj', $this->address);
        $result = $this->client->Zaloguj(
            [
            RegonConstantsInterface::PARAM_USER_KEY => $userKey
            ]
        );

        $sid = $result->ZalogujResult;
        return $sid;
    }

    /**
     * @inheritdoc
     */
    public function logout($sid)
    {
        $this->prepareSoapHeader('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Wyloguj', $this->address);
        $result = $this->client->Wyloguj(
            [
            RegonConstantsInterface::PARAM_SESSION_ID => $sid
            ]
        );

        return $result->WylogujResult;
    }

    /**
     * @inheritdoc
     */
    public function search($sid, array $parameters)
    {
        $this->prepareSoapHeader('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneSzukaj', $this->address, $sid);

        $result = $this->client->DaneSzukaj(
            [
            RegonConstantsInterface::PARAM_SEARCH => $parameters
            ]
        );

        try {
            $result = $this->decodeResponse($result->DaneSzukajResult);
        } catch (\Exception $e) {
            throw new NoDataException("No data found for");
        }

        return $result->dane;
    }

    /**
     * @inheritdoc
     */
    public function getFullData($sid, $regon, $reportType)
    {
        $this->prepareSoapHeader('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzPelnyRaport', $this->address, $sid);
        $result = $this->client->DanePobierzPelnyRaport(
            [
            RegonConstantsInterface::PARAM_REGON => $regon,
            RegonConstantsInterface::PARAM_REPORT_NAME => $reportType
            ]
        );

        try {
            $result = $this->decodeResponse($result->DanePobierzPelnyRaportResult);
        } catch (\Exception $e) {
            throw new NoDataException("No data found");
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getValue($sid, $param)
    {
        $this->prepareSoapHeader('http://CIS/BIR/2014/07/IUslugaBIR/GetValue', $this->address, $sid);
        $result = $this->client->GetValue(
            [
            RegonConstantsInterface::PARAM_PARAM_NAME => $param
            ]
        );

        return $result->GetValueResult;
    }

    /**
     * Prepare soap necessary header
     *
     * @param string      $action
     * @param string      $to
     * @param null|string $sid    session id
     */
    protected function prepareSoapHeader($action, $to, $sid = null)
    {
        $this->clearHeader();
        $header[] = $this->setHeader('http://www.w3.org/2005/08/addressing', 'Action', $action);
        $header[] = $this->setHeader('http://www.w3.org/2005/08/addressing', 'To', $to);
        $this->client->__setSoapHeaders($header);

        if ($sid !== null) {
            $this->client->__setHttpHeader(
                [
                'header' => 'sid: '.$sid
                ]
            );
        }
    }

    /**
     * Clear soap header
     */
    protected function clearHeader()
    {
        $this->client->__setSoapHeaders(null);
    }

    /**
     * Set soap header
     *
     * @param  $namespace
     * @param  $name
     * @param  null      $data
     * @param  bool      $mustUnderstand
     * @return \SoapHeader
     */
    protected function setHeader($namespace, $name, $data = null, $mustUnderstand = false)
    {
        return new \SoapHeader($namespace, $name, $data, $mustUnderstand);
    }

    /**
     * @param string $response xml string
     * @return \SimpleXMLElement
     */
    protected function decodeResponse($response)
    {
        return new \SimpleXMLElement($response);
    }
}