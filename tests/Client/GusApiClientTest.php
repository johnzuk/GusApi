<?php

namespace GusApi\Tests\Client;

use GusApi\Client\GusApiClient;
use GusApi\Context\Context;
use GusApi\ParamName;
use GusApi\Type\Request\GetFullReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\SearchData;
use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetFullReportResponseRaw;
use GusApi\Type\Response\GetValueResponse;
use GusApi\Type\Response\LoginResponse;
use GusApi\Type\Response\LogoutResponse;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\Response\SearchResponseRaw;
use GusApi\Type\SearchParameters;
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

    public function testCallWithValidFunctionName()
    {
        $this->expectSoapCall('Zaloguj', [new Login('1234567890')], new LoginResponse('0987654321'));

        $this->assertEquals(
            new LoginResponse('0987654321'),
            $this->gusApiClient->login(new Login('1234567890'))
        );
    }

    public function testLogin()
    {
        $this->expectSoapCall('Zaloguj', [new Login('1234567890')], new LoginResponse('0987654321'));

        $this->assertEquals(
            new LoginResponse('0987654321'),
            $this->gusApiClient->login(new Login('1234567890'))
        );
    }

    public function testLogout()
    {
        $this->expectSoapCall('Wyloguj', [new Logout('1234567890')], new LogoutResponse(true));
        $logoutResult = $this->gusApiClient->logout(new Logout('1234567890'));

        $this->assertTrue($logoutResult->getWylogujResult());
    }

    public function testGetValue()
    {
        $this->expectSoapCall('GetValue', [new GetValue('StanDanych')], new GetValueResponse('stan danych response'), false);
        $value = $this->gusApiClient->getValue(new GetValue(ParamName::STATUS_DATE_STATE));

        $this->assertSame('stan danych response', $value->getGetValueResult());
    }

    public function testSearchData()
    {
        $searchRawResponse = file_get_contents(__DIR__.'/../resources/response/searchDataResponseResult.xsd');
        $searchData = new SearchData((new SearchParameters())->setNip('0011223344'));
        $this->expectSoapCall('DaneSzukaj', [$searchData], new SearchResponseRaw($searchRawResponse));

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

        $this->assertEquals($expected, $this->gusApiClient->searchData($searchData, '1234567890'));
    }

    /**
     * @expectedException  \GusApi\Exception\NotFoundException
     */
    public function testSearchDataNotFound()
    {
        $searchData = new SearchData((new SearchParameters())->setNip('0011223344'));
        $this->expectSoapCall('DaneSzukaj', [$searchData], new SearchResponseRaw(''));

        $this->gusApiClient->searchData($searchData, '1234567890');
    }

    public function testGetFullReport()
    {
        $searchRawResponse = file_get_contents(__DIR__.'/../resources/response/fullSearchResponse.xsd');
        $searchData = new GetFullReport('00112233445566', 'PublDaneRaportTypJednostki');
        $this->expectSoapCall(
            'DanePobierzPelnyRaport',
            [$searchData],
            new GetFullReportResponseRaw($searchRawResponse)
        );

        $this->assertEquals(
            new GetFullReportResponse([
                [
                    'fiz_regon9' => '666666666',
                    'fiz_nazwa' => 'NIEPUBLICZNY ZAKŁAD OPIEKI ZDROWOTNEJ xxxxxxxxxxxxx',
                    'fiz_nazwaSkrocona' => '',
                    'fiz_dataPowstania' => '1993-03-20',
                    'fiz_dataRozpoczeciaDzialalnosci' => '1999-10-20',
                    'fiz_dataWpisuDoREGONDzialalnosci' => '',
                    'fiz_dataZawieszeniaDzialalnosci' => '',
                    'fiz_dataWznowieniaDzialalnosci' => '',
                    'fiz_dataZaistnieniaZmianyDzialalnosci' => '2011-08-16',
                    'fiz_dataZakonczeniaDzialalnosci' => '',
                    'fiz_dataSkresleniazRegonDzialalnosci' => '',
                    'fiz_adSiedzKraj_Symbol' => '',
                    'fiz_adSiedzWojewodztwo_Symbol' => '30',
                    'fiz_adSiedzPowiat_Symbol' => '22',
                    'fiz_adSiedzGmina_Symbol' => '059',
                    'fiz_adSiedzKodPocztowy' => '69000',
                    'fiz_adSiedzMiejscowoscPoczty_Symbol' => '0198380',
                    'fiz_adSiedzMiejscowosc_Symbol' => '0198380',
                    'fiz_adSiedzUlica_Symbol' => '1240',
                    'fiz_adSiedzNumerNieruchomosci' => '99',
                    'fiz_adSiedzNumerLokalu' => '',
                    'fiz_adSiedzNietypoweMiejsceLokalizacji' => '',
                    'fiz_numerTelefonu' => '',
                    'fiz_numerWewnetrznyTelefonu' => '',
                    'fiz_numerFaksu' => '9999999999',
                    'fiz_adresEmail' => '',
                    'fiz_adresStronyinternetowej' => '',
                    'fiz_adresEmail2' => '',
                    'fiz_adSiedzKraj_Nazwa' => '',
                    'fiz_adSiedzWojewodztwo_Nazwa' => 'WIELKOPOLSKIE',
                    'fiz_adSiedzPowiat_Nazwa' => 'xxxxxxxxxx',
                    'fiz_adSiedzGmina_Nazwa' => 'Yyyyyyyy',
                    'fiz_adSiedzMiejscowosc_Nazwa' => 'Yyyyyyyy',
                    'fiz_adSiedzMiejscowoscPoczty_Nazwa' => 'Yyyyyyyy',
                    'fiz_adSiedzUlica_Nazwa' => 'ul. Adama Mickiewicza',
                    'fizP_dataWpisuDoRejestruEwidencji' => '',
                    'fizP_numerwRejestrzeEwidencji' => '',
                    'fizP_OrganRejestrowy_Symbol' => '',
                    'fizP_OrganRejestrowy_Nazwa' => '',
                    'fizP_RodzajRejestru_Symbol' => '099',
                    'fizP_RodzajRejestru_Nazwa' => 'PODMIOTY NIE PODLEGAJĄCE WPISOM DO REJESTRU LUB EWIDENCJI',
                ],
            ]),
            $this->gusApiClient->getFullReport($searchData, '1234567890')
        );
    }

    public function testGetFullReportMultiple()
    {
        $searchRawResponse = file_get_contents(__DIR__.'/../resources/response/fullSearchMultipleResponse.xsd');
        $searchData = new GetFullReport('00112233445566', 'PublDaneRaportDzialalnosciPrawnej');
        $this->expectSoapCall(
            'DanePobierzPelnyRaport',
            [$searchData],
            new GetFullReportResponseRaw($searchRawResponse)
        );

        $this->assertEquals(
            new GetFullReportResponse([
                [
                    'praw_pkdKod' => '7430Z',
                    'praw_pkdNazwa' => 'DZIAŁALNOŚĆ ZWIĄZANA Z TŁUMACZENIAMI',
                    'praw_pkdPrzewazajace' => '0',
                ],
                [
                    'praw_pkdKod' => '7420Z',
                    'praw_pkdNazwa' => 'DZIAŁALNOŚĆ FOTOGRAFICZNA',
                    'praw_pkdPrzewazajace' => '0',
                ],
                [
                    'praw_pkdKod' => '7410Z',
                    'praw_pkdNazwa' => 'DZIAŁALNOŚĆ W ZAKRESIE SPECJALISTYCZNEGO PROJEKTOWANIA',
                    'praw_pkdPrzewazajace' => '1',
                ],
            ]),
            $this->gusApiClient->getFullReport($searchData, '1234567890')
        );
    }

    protected function getHeaders($action, $to)
    {
        return [
            new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', $action),
            new \SoapHeader('http://www.w3.org/2005/08/addressing', 'To', $to),
        ];
    }

    protected function expectSoapCall(string $action, array $arguments, $result, bool $public = true)
    {
        $baseUrl = $public ? 'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl' : 'http://CIS/BIR/2014/07/IUslugaBIR';
        $headers = $this->getHeaders(sprintf('%s/%s', $baseUrl, $action), 'Location');
        $this->soap
            ->expects($this->once())
            ->method('__soapCall')
            ->with($action, $arguments, [], $headers)
            ->willReturn($result);
    }
}
