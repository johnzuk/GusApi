<?php

namespace GusApi\Tests;

use GusApi\Client\GusApiClient;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use GusApi\SearchReport;
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
use GusApi\Type\SearchParameters;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GusApiTest extends TestCase
{
    use ExampleCompanyTrait;

    protected $userKey = '123absdefg123';
    protected $sessionId = '12sessionid21';

    /**
     * @var MockObject|GusApiClient
     */
    protected $apiClient;

    /**
     * @var GusApi
     */
    protected $api;

    public function setUp()
    {
        $this->apiClient = $this->createMock(GusApiClient::class);
        $this->api = GusApi::createWithApiClient($this->userKey, $this->apiClient);
    }

    public function testLogin()
    {
        $this->assertSame($this->userKey, $this->api->getUserKey());
        $this->assertTrue($this->login());
        $this->assertSame($this->sessionId, $this->api->getSessionId());
    }

    public function testLogout()
    {
        $this->apiClient
            ->expects($this->once())
            ->method('logout')
            ->with(new Logout($this->sessionId))
            ->willReturn(new LogoutResponse(true));

        $this->api->setSessionId($this->sessionId);
        $this->assertTrue($this->api->logout());
    }

    public function testGetSessionStatus()
    {
        $this->apiClient
            ->expects($this->exactly(2))
            ->method('getValue')
            ->with(new GetValue('StatusSesji'), $this->sessionId)
            ->willReturn(new GetValueResponse('1'));

        $this->api->setSessionId($this->sessionId);
        $this->assertSame(1, $this->api->getSessionStatus());
        $this->assertTrue($this->api->isLogged());
    }

    public function testInvalidLogin()
    {
        $this->expectException(InvalidUserKeyException::class);
        $this->apiClient
            ->expects($this->once())
            ->method('login')
            ->with(new Login('invalid-key'))
            ->willReturn(new LoginResponse(''));

        $this->api->setUserKey('invalid-key');
        $this->api->login();
    }

    /**
     * @dataProvider searchParameterProvider
     *
     * @param string $method    GusApi method to call
     * @param string $parameter search parameter name
     * @param mixed  $value     parameter value
     */
    public function testSearchByParameter(string $method, string $parameter, $value)
    {
        $this->login();
        $parameters = $this->getSearchParameters($parameter, $value);
        $this->expectSearchWithParameters($parameters);

        $result = $this->api->$method($value);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(SearchReport::class, $result[0]);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetFullReport()
    {
        $searchReport = $this->createMock(SearchReport::class);
        $searchReport->method('getRegon14')->willReturn('61018820100000');
        $response = file_get_contents(__DIR__.'/resources/response/fullSearchResponse.xsd');
        $this->apiClient
            ->expects($this->once())
            ->method('getFullReport')
            ->with(new GetFullReport('61018820100000', 'PublDaneRaportPrawna'), $this->sessionId)
            ->willReturn(new GetFullReportResponse(new \SimpleXMLElement($response)))
        ;

        $this->login();
        $fullReport = $this->api->getFullReport($searchReport, ReportTypes::REPORT_PUBLIC_LAW);
        $this->assertInstanceOf(\SimpleXMLElement::class, $fullReport);
        $this->assertXmlStringEqualsXmlString($response, $fullReport->asXML());
    }

    public function testTooManyNipsRaisesAnException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->api->getByNips(array_fill(0, 21, '7740001454'));
    }

    public function testGetDataStatus()
    {
        $this->expectGetValueCall('StanDanych', '2014-12-31');
        $this->assertInstanceOf(\DateTime::class, $this->api->dataStatus());
    }

    public function testGetServiceStatus()
    {
        $this->expectGetValueCall('StatusUslugi', '1');
        $this->assertSame(1, $this->api->serviceStatus());
    }

    public function testGetServiceMessage()
    {
        $this->expectGetValueCall('KomunikatUslugi', 'Example service message');
        $this->assertSame('Example service message', $this->api->serviceMessage());
    }

    public function testGetMessage()
    {
        $this->expectGetValueCall('KomunikatTresc', 'Example message');
        $this->assertSame('Example message', $this->api->getMessage());
    }

    public function testGetMessageCode()
    {
        $this->expectGetValueCall('KomunikatKod', '1');
        $this->assertSame(1, $this->api->getMessageCode());
    }

    public function searchParameterProvider()
    {
        return [
            ['getByKrs', 'krs', '28860'],
            ['getByKrses', 'krsy', ['28860']],
            ['getByNip', 'nip', '7740001454'],
            ['getByNips', 'nipy', ['7740001454']],
            ['getByRegon', 'regon', '610188201'],
            ['getByRegons9', 'regony9zn', ['610188201']],
            ['getByRegons14', 'regony14zn', ['61018820100000']],
        ];
    }

    protected function expectGetValueCall(string $parameter, string $value)
    {
        $this->apiClient
            ->expects($this->once())
            ->method('getValue')
            ->with(new GetValue($parameter))
            ->willReturn(new GetValueResponse($value));
    }

    /**
     * @param string $parameter
     * @param mixed  $value
     *
     * @return SearchParameters
     */
    protected function getSearchParameters(string $parameter, $value): SearchParameters
    {
        $setter = 'set'.ucfirst($parameter);
        $value = is_array($value) ? implode(',', $value) : $value;

        return (new SearchParameters())->$setter($value);
    }

    protected function expectSearchWithParameters(SearchParameters $parameters)
    {
        $response = $this->createMock(SearchDataResponse::class);
        $response->method('getDaneSzukajResult')->willReturn([$this->getExampleResponseData()]);
        $this->apiClient
            ->expects($this->once())
            ->method('searchData')
            ->with(new SearchData($parameters), $this->sessionId)
            ->willReturn($response);
    }

    protected function login(): bool
    {
        $this->apiClient
            ->expects($this->once())
            ->method('login')
            ->with(new Login($this->userKey))
            ->willReturn(new LoginResponse($this->sessionId));

        return $this->api->login();
    }
}
