<?php

namespace GusApi\Client;

use GusApi\Context\Context;
use GusApi\RegonConstantsInterface;
use GusApi\Type\GetFullReport;
use GusApi\Type\GetFullReportResponse;
use GusApi\Type\GetFullReportResponseRaw;
use GusApi\Type\GetValue;
use GusApi\Type\GetValueResponse;
use GusApi\Type\Login;
use GusApi\Type\LoginResponse;
use GusApi\Type\Logout;
use GusApi\Type\LogoutResponse;
use GusApi\Type\SearchData;
use GusApi\Type\SearchDataResponse;
use GusApi\Type\SearchParameters;
use GusApi\Type\SearchResponseCompanyData;
use GusApi\Type\SearchResponseRaw;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GusApiClientTest extends TestCase
{
    /**
     * @var GusApiClient
     */
    protected $gusApiClient;

    /**
     * @var MockObject
     */
    protected $soap;

    public function setUp()
    {
        $this->soap = $this->getMockFromWsdl(__DIR__.'/../UslugaBIRzewnPubl.xsd');

        $this->gusApiClient = new GusApiClient($this->soap, 'Location', new Context());
    }

    public function testGetRequestHeaders()
    {
        $headers = GusApiClient::getRequestHeaders('TestAction', 'TestTo');

        $this->assertEquals(
            [
                new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'TestAction'),
                new \SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'TestTo'),
            ],
            $headers
        );
    }

    public function testCallWithValidFunctionName()
    {
        $headers = $this->getHeaders('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Zaloguj', 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('Zaloguj'),
                $this->equalTo(new Login('1234567890')),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new LoginResponse('0987654321'));

        $this->assertEquals(
            new LoginResponse('0987654321'),
            $this->gusApiClient->call('Zaloguj', new Login('1234567890'))
        );
    }

    /**
     * @expectedException \GusApi\Exception\InvalidActionNameException
     */
    public function testCallWithInvalidFunctionName()
    {
        $this->gusApiClient->call('InvalidFunctionName', new Login('1234567890'));
    }

    public function testLogin()
    {
        $headers = $this->getHeaders('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Zaloguj', 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('Zaloguj'),
                $this->equalTo([
                    new Login('1234567890'),
                ]),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new LoginResponse('0987654321'));

        $this->assertEquals(
            new LoginResponse('0987654321'),
            $this->gusApiClient->login(new Login('1234567890'))
        );
    }

    public function testLogout()
    {
        $headers = $this->getHeaders('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Wyloguj', 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('Wyloguj'),
                $this->equalTo([
                    new Logout('1234567890'),
                ]),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new LogoutResponse(true));

        $this->assertEquals(
            new LogoutResponse(true),
            $this->gusApiClient->logout(new Logout('1234567890'))
        );
    }

    public function testGetValue()
    {
        $headers = $this->getHeaders('http://CIS/BIR/2014/07/IUslugaBIR/GetValue', 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('GetValue'),
                $this->equalTo([
                    new GetValue('StanDanych'),
                ]),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new GetValueResponse('stan danych response'));

        $this->assertEquals(
            new GetValueResponse('stan danych response'),
            $this->gusApiClient->getValue(new GetValue(RegonConstantsInterface::PARAM_STATUS_DATE_STATE))
        );
    }

    public function testSearchData()
    {
        $searchRawResponse = file_get_contents(__DIR__.'/../resources/response/searchDataResponseResult.xsd');
        $headers = $this->getHeaders('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneSzukaj', 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('DaneSzukaj'),
                $this->equalTo([
                    new SearchData((new SearchParameters())->setNip('0011223344')),
                ]),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new SearchResponseRaw($searchRawResponse));

        $companyData = new SearchResponseCompanyData();
        $companyData->Regon = '02092251199990';
        $companyData->RegonLink = 'Link Dane';
        $companyData->Nazwa = 'ZAKŁAD MALARSKI TEST';
        $companyData->Wojewodztwo = 'DOLNOŚLĄSKIE';
        $companyData->Powiat = 'm. Wrocław';
        $companyData->Gmina = 'Wrocław-Stare Miasto';
        $companyData->Miejscowosc = 'Wrocław';
        $companyData->KodPocztowy = '50-038';
        $companyData->Ulica = 'ul. Test-Krucza';
        $companyData->Typ = 'P';
        $companyData->SilosID = 6;

        $expected = new SearchDataResponse([
            $companyData,
        ]);
        $this->assertEquals(
            $expected,
            $this->gusApiClient->searchData(
                new SearchData((new SearchParameters())->setNip('0011223344')),
                '1234567890'
            )
        );
    }

    /**
     * @expectedException  \GusApi\Exception\NotFoundException
     */
    public function testSearchDataNotFound()
    {
        $headers = $this->getHeaders('http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneSzukaj', 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('DaneSzukaj'),
                $this->equalTo([
                    new SearchData((new SearchParameters())->setNip('0011223344')),
                ]),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new SearchResponseRaw(''));

        $this->gusApiClient->searchData(
            new SearchData((new SearchParameters())->setNip('0011223344')),
            '1234567890'
        );
    }

    public function testGetFullReport()
    {
        $searchRawResponse = file_get_contents(__DIR__.'/../resources/response/fullSearchResponse.xsd');
        $headers = $this->getHeaders(
            'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzPelnyRaport',
            'Location'
        );

        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with(
                $this->equalTo('DanePobierzPelnyRaport'),
                $this->equalTo([
                    new GetFullReport('00112233445566', 'PublDaneRaportTypJednostki'),
                ]),
                $this->isNull(),
                $this->equalTo($headers)
            )
            ->willReturn(new GetFullReportResponseRaw('<report>'.$searchRawResponse.'</report>'));

        $this->assertEquals(
            new GetFullReportResponse(new \SimpleXMLElement($searchRawResponse)),
            $this->gusApiClient->getFullReport(
                new GetFullReport('00112233445566', 'PublDaneRaportTypJednostki'),
                '1234567890'
            )
        );
    }

    public function getHeaders($action, $to)
    {
        return [
            new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', $action),
            new \SoapHeader('http://www.w3.org/2005/08/addressing', 'To', $to),
        ];
    }
}
