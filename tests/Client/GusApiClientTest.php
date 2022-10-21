<?php

declare(strict_types=1);

namespace GusApi\Tests\Client;

use GusApi\Client\GusApiClient;
use GusApi\Context\Context;
use GusApi\Exception\NotFoundException;
use GusApi\ParamName;
use GusApi\Tests\GetContentTrait;
use GusApi\Type\Request\GetBulkReport;
use GusApi\Type\Request\GetFullReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\SearchData;
use GusApi\Type\Request\SearchParameters;
use GusApi\Type\Response\GetBulkReportResponseRaw;
use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetFullReportResponseRaw;
use GusApi\Type\Response\GetValueResponse;
use GusApi\Type\Response\LoginResponse;
use GusApi\Type\Response\LogoutResponse;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\Response\SearchResponseRaw;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SoapClient;

final class GusApiClientTest extends TestCase
{
    use GetContentTrait;

    private GusApiClient $gusApiClient;

    private SoapClient|MockObject $soap;

    protected function setUp(): void
    {
        $this->soap = $this->getMockFromWsdl(__DIR__ . '/../UslugaBIRzewnPubl.xsd', SoapClient::class, '', [], false);
        $this->gusApiClient = new GusApiClient($this->soap, 'Location', new Context());
    }

    public function testLogin(): void
    {
        $this->expectSoapCall(
            'Zaloguj',
            [
                [
                    'pKluczUzytkownika' => '1234567890',
                ],
            ],
            new LoginResponse('0987654321')
        );

        self::assertEquals(
            new LoginResponse('0987654321'),
            $this->gusApiClient->login(new Login('1234567890'))
        );
    }

    public function testLogout(): void
    {
        $this->expectSoapCall(
            'Wyloguj',
            [
                [
                    'pIdentyfikatorSesji' => '1234567890',
                ],
            ],
            new LogoutResponse(true)
        );

        $logoutResult = $this->gusApiClient->logout(new Logout('1234567890'));
        self::assertTrue($logoutResult->getWylogujResult());
    }

    public function testGetValue(): void
    {
        $this->expectSoapCall(
            'GetValue',
            [
                [
                    'pNazwaParametru' => 'StanDanych',
                ],
            ],
            new GetValueResponse('stan danych response'),
            false
        );

        $value = $this->gusApiClient->getValue(new GetValue(ParamName::STATUS_DATE_STATE));

        self::assertSame('stan danych response', $value->getGetValueResult());
    }

    public function testSearchDataWithSingleResponse(): void
    {
        $searchRawResponse = self::getContent(__DIR__ . '/../resources/response/searchDataResponseResultSingle.xsd');
        $searchData = new SearchData(new SearchParameters(null, null, '0099112233', null, null, null, null));

        $this->expectSoapCall(
            'DaneSzukajPodmioty',
            [
                [
                    'pParametryWyszukiwania' => [
                        'Krs' => null,
                        'Krsy' => null,
                        'Nip' => '0099112233',
                        'Nipy' => null,
                        'Regon' => null,
                        'Regony9zn' => null,
                        'Regony14zn' => null,
                    ],
                ],
            ],
            new SearchResponseRaw($searchRawResponse)
        );

        $companyData = new SearchResponseCompanyData();
        $companyData->Regon = '02092251199990';
        $companyData->Nip = '0099112233';
        $companyData->StatusNip = '';
        $companyData->Nazwa = 'ZAKŁAD MALARSKI TEST';
        $companyData->Wojewodztwo = 'DOLNOŚLĄSKIE';
        $companyData->Powiat = 'm. Wrocław';
        $companyData->Gmina = 'Wrocław-Stare Miasto';
        $companyData->Miejscowosc = 'Wrocław';
        $companyData->KodPocztowy = '50-038';
        $companyData->Ulica = 'ul. Test-Krucza';
        $companyData->NrNieruchomosci = '208';
        $companyData->NrLokalu = '';
        $companyData->Typ = 'P';
        $companyData->SilosID = '6';
        $companyData->DataZakonczeniaDzialalnosci = '';

        $expected = new SearchDataResponse([
            $companyData,
        ]);

        self::assertEquals($expected, $this->gusApiClient->searchData($searchData, '1234567890'));
    }

    public function testSearchDataWithMultipleResponse(): void
    {
        $searchRawResponse = self::getContent(__DIR__ . '/../resources/response/searchDataReponseResultMulti.xsd');
        $searchData = new SearchData(new SearchParameters(null, null, '0099112233', null, null, null, null));
        $this->expectSoapCall(
            'DaneSzukajPodmioty',
            [
                [
                    'pParametryWyszukiwania' => [
                        'Krs' => null,
                        'Krsy' => null,
                        'Nip' => '0099112233',
                        'Nipy' => null,
                        'Regon' => null,
                        'Regony9zn' => null,
                        'Regony14zn' => null,
                    ],
                ],
            ],
            new SearchResponseRaw($searchRawResponse)
        );

        $firstCompanyData = new SearchResponseCompanyData();
        $firstCompanyData->Regon = '02092251199990';
        $firstCompanyData->Nip = '0099112233';
        $firstCompanyData->StatusNip = '';
        $firstCompanyData->Nazwa = 'ZAKŁAD MALARSKI TEST';
        $firstCompanyData->Wojewodztwo = 'DOLNOŚLĄSKIE';
        $firstCompanyData->Powiat = 'm. Wrocław';
        $firstCompanyData->Gmina = 'Wrocław-Stare Miasto';
        $firstCompanyData->Miejscowosc = 'Wrocław';
        $firstCompanyData->KodPocztowy = '50-038';
        $firstCompanyData->Ulica = 'ul. Test-Krucza';
        $firstCompanyData->NrNieruchomosci = '208';
        $firstCompanyData->NrLokalu = '';
        $firstCompanyData->Typ = 'P';
        $firstCompanyData->SilosID = '6';
        $firstCompanyData->DataZakonczeniaDzialalnosci = '';

        $secondCompanyData = new SearchResponseCompanyData();
        $secondCompanyData->Regon = '02092251199990';
        $secondCompanyData->Nip = '0099112233';
        $secondCompanyData->StatusNip = '';
        $secondCompanyData->Nazwa = 'GOSPODARSTWO ROLNE';
        $secondCompanyData->Wojewodztwo = 'LUBELSKIE';
        $secondCompanyData->Powiat = 'kraśnicki';
        $secondCompanyData->Gmina = 'Zakrzówek';
        $secondCompanyData->Miejscowosc = 'Sulów';
        $secondCompanyData->KodPocztowy = '23-213';
        $secondCompanyData->Ulica = 'ul. Test-Krucza';
        $secondCompanyData->NrNieruchomosci = '12';
        $secondCompanyData->NrLokalu = '33';
        $secondCompanyData->Typ = 'F';
        $secondCompanyData->SilosID = '2';
        $secondCompanyData->DataZakonczeniaDzialalnosci = '';

        $expected = new SearchDataResponse([
            $firstCompanyData,
            $secondCompanyData,
        ]);

        self::assertEquals($expected, $this->gusApiClient->searchData($searchData, '1234567890'));
    }

    public function testSearchDataNotFound(): void
    {
        $searchData = new SearchData(new SearchParameters(null, null, '0099112233', null, null, null, null));
        $this->expectSoapCall(
            'DaneSzukajPodmioty',
            [
                [
                    'pParametryWyszukiwania' => [
                        'Krs' => null,
                        'Krsy' => null,
                        'Nip' => '0099112233',
                        'Nipy' => null,
                        'Regon' => null,
                        'Regony9zn' => null,
                        'Regony14zn' => null,
                    ],
                ],
            ],
            new SearchResponseRaw('')
        );

        $this->expectException(NotFoundException::class);
        $this->gusApiClient->searchData($searchData, '1234567890');
    }

    public function testGetBulkReport(): void
    {
        $searchRawResponse = self::getContent(__DIR__ . '/../resources/response/bulkReportResponse.xsd');
        $searchData = new GetBulkReport('2019-01-01', 'BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych');

        $this->expectSoapCall(
            'DanePobierzRaportZbiorczy',
            [
                [
                    'pDataRaportu' => '2019-01-01',
                    'pNazwaRaportu' => 'BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych',
                ],
            ],
            new GetBulkReportResponseRaw($searchRawResponse)
        );

        self::assertEquals([
            '022399999',
            '147210456',
            '243544401',
            '341568222',
        ], $this->gusApiClient->getBulkReport($searchData, '1234567890'));
    }

    public function testGetFullReport(): void
    {
        $searchRawResponse = self::getContent(__DIR__ . '/../resources/response/fullSearchResponse.xsd');
        $searchData = new GetFullReport('00112233445566', 'PublDaneRaportTypJednostki');
        $this->expectSoapCall(
            'DanePobierzPelnyRaport',
            [
                [
                    'pRegon' => '00112233445566',
                    'pNazwaRaportu' => 'PublDaneRaportTypJednostki',
                ],
            ],
            new GetFullReportResponseRaw($searchRawResponse)
        );

        self::assertEquals(
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

    public function testGetFullReportMultiple(): void
    {
        $searchRawResponse = self::getContent(__DIR__ . '/../resources/response/fullSearchMultipleResponse.xsd');
        $searchData = new GetFullReport('00112233445566', 'PublDaneRaportDzialalnosciPrawnej');
        $this->expectSoapCall(
            'DanePobierzPelnyRaport',
            [
                [
                    'pRegon' => '00112233445566',
                    'pNazwaRaportu' => 'PublDaneRaportDzialalnosciPrawnej',
                ],
            ],
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

    private function getHeaders(string $action, string $to): array
    {
        return [
            new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', $action),
            new \SoapHeader('http://www.w3.org/2005/08/addressing', 'To', $to),
        ];
    }

    private function expectSoapCall(string $action, array $arguments, object $result, bool $public = true): void
    {
        $baseUrl = $public ? 'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl' : 'http://CIS/BIR/2014/07/IUslugaBIR';
        $headers = $this->getHeaders(sprintf('%s/%s', $baseUrl, $action), 'Location');
        $this->soap
            ->expects(self::once())
            ->method('__soapCall')
            ->with($action, $arguments, [], $headers)
            ->willReturn($result);
    }
}
