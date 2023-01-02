<?php

declare(strict_types=1);

namespace GusApi\Tests;

use BadMethodCallException;
use DateTimeImmutable;
use DateTimeZone;
use GusApi\Client\GusApiClient;
use GusApi\Exception\InvalidReportTypeException;
use GusApi\Exception\InvalidServerResponseException;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\SearchReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\SearchData;
use GusApi\Type\Request\SearchParameters;
use GusApi\Type\Response\GetFullReportResponse;
use GusApi\Type\Response\GetValueResponse;
use GusApi\Type\Response\LoginResponse;
use GusApi\Type\Response\LogoutResponse;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GusApiTest extends TestCase
{
    /** @var GusApiClient&MockObject */
    private GusApiClient|MockObject $apiClient;
    private GusApi $api;

    protected function setUp(): void
    {
        $this->apiClient = $this->createMock(GusApiClient::class);
        $this->api = GusApi::createWithApiClient('123absdefg123', $this->apiClient);
    }

    public function testLoginWillReturnTrueWhenLoginCorrectly(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        self::assertTrue($this->api->login());
    }

    public function testLoginWillSetSessionId(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->api->login();

        self::assertSame('12sessionid21', $this->api->getSessionId());
    }

    public function testSetSessionIdWillSetSession(): void
    {
        $this->api->setSessionId("12sessionid21");
        $this->mockApiClientGetValueCall('StatusSesji', '1');
        self::assertTrue($this->api->isLogged());
    }

    public function testGetSessionIdFailsWhenNotLoggedIn(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Session is not started. Call login() first.');
        $this->api->getSessionId();
    }

    public function testLoginWillThrowExceptionWhenResponseIsEmpty(): void
    {
        $this->expectException(InvalidUserKeyException::class);
        $this->apiClient
            ->expects(self::once())
            ->method('login')
            ->with(new Login('123absdefg123'))
            ->willReturn(new LoginResponse(''));

        $this->api->login();
    }

    public function testLogout(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->apiClient
            ->expects(self::once())
            ->method('logout')
            ->with(new Logout('12sessionid21'))
            ->willReturn(new LogoutResponse(true));

        self::assertTrue($this->api->logout());
    }

    public function testIsLogged(): void
    {
        $this->expectGetValueCall('StatusSesji', '1');
        self::assertTrue($this->api->isLogged());
    }

    public function testIsLoggedReturnsFalseWhenSessionIdIsEmpty(): void
    {
        self::assertFalse($this->api->isLogged());
    }

    public function testGetDataStatus(): void
    {
        $this->expectGetValueCall('StanDanych', '31-12-2014');
        self::assertEquals(
            DateTimeImmutable::createFromFormat(
                'd-m-Y',
                '31-12-2014',
                new DateTimeZone('Europe/Warsaw')
            ),
            $this->api->dataStatus()
        );
    }

    public function testGetDataStatusWillThrowExceptionWhenInvalidDataFormatReturned(): void
    {
        $this->expectException(InvalidServerResponseException::class);

        $this->expectGetValueCall('StanDanych', '');
        $this->api->dataStatus();
    }

    public function testGetServiceStatus(): void
    {
        $this->expectGetValueCall('StatusUslugi', '1');
        $this->assertSame(1, $this->api->serviceStatus());
    }

    public function testGetServiceMessage(): void
    {
        $this->expectGetValueCall('KomunikatUslugi', 'Example service message');
        $this->assertSame('Example service message', $this->api->serviceMessage());
    }

    public function testGetByNip(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters(null, null, '123123123', null, null, null, null));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByNip('123123123')
        );
    }

    public function testGetByRegon(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters(null, null, null, null, '123123123', null, null));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByRegon('123123123')
        );
    }

    public function testGetByKrs(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters('123123123', null, null, null, null, null, null));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByKrs('123123123')
        );
    }

    public function testGetByNips(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters(null, null, null, '123123123,123123124', null, null, null));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByNips(['123123123', '123123124'])
        );
    }

    public function testGetByNipsWillThrowExceptionWhenToManyIdentifiersProvided(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->expectException(InvalidArgumentException::class);
        $this->api->getByNips(array_fill(0, 21, '123123123'));
    }

    public function testGetByKrses(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters(null, '123123123,123123124', null, null, null, null, null));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByKrses(['123123123', '123123124'])
        );
    }

    public function testGetByRegons9(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters(null, null, null, null, null, null, '123123123,123123124'));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByRegons9(['123123123', '123123124'])
        );
    }

    public function testGetByregons14(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->setUpSearchParameters(new SearchParameters(null, null, null, null, null, '123123123,123123124', null));

        self::assertEquals(
            [
                new SearchReport(
                    new SearchResponseCompanyData()
                ),
            ],
            $this->api->getByregons14(['123123123', '123123124'])
        );
    }

    public function testGetFullReport(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->apiClient
            ->expects(self::once())
            ->method('getFullReport')
            ->willReturn(new GetFullReportResponse([['test' => '1234']]));

        self::assertSame(
            [['test' => '1234']],
            $this->api->getFullReport(
                new SearchReport(new SearchResponseCompanyData()),
                'BIR11OsFizycznaDaneOgolne'
            )
        );
    }

    public function testGetBulkReportWillThrowExceptionWhenInvalidReportTypeProvided(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->expectException(InvalidReportTypeException::class);
        $this->api->getBulkReport(new DateTimeImmutable(), 'asdf');
    }

    public function testGetBulkReport(): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->apiClient->expects(self::once())->method('getBulkReport')->willReturn(['test' => 'test']);

        self::assertSame(
            [
                'test' => 'test',
            ],
            $this->api->getBulkReport(new DateTimeImmutable(), 'BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych')
        );
    }

    public function testGetMessageCode(): void
    {
        $this->expectGetValueCall('KomunikatKod', '3');
        self::assertSame(3, $this->api->getMessageCode());
    }

    public function testGetMessage(): void
    {
        $this->expectGetValueCall('KomunikatTresc', 'Invalid Test');
        self::assertSame('Invalid Test', $this->api->getMessage());
    }

    public function testItThrowsBadMethodCallExceptionWhenLoginWasNotCalled(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Session is not started. Call login() first.');
        $this->api->getMessageCode();
    }

    public function testGetSessionStatus(): void
    {
        $this->expectGetValueCall('StatusSesji', '1');
        self::assertSame(1, $this->api->getSessionStatus());
    }

    private function expectGetValueCall(string $parameter, string $value): void
    {
        $this->loginApiWithSessionId('12sessionid21');
        $this->mockApiClientGetValueCall($parameter, $value);
    }

    private function mockApiClientGetValueCall(string $parameter, string $value): void
    {
        $this->apiClient
            ->expects(self::once())
            ->method('getValue')
            ->with(new GetValue($parameter))
            ->willReturn(new GetValueResponse($value));
    }

    private function setUpSearchParameters(SearchParameters $parameters): void
    {
        $this->apiClient
            ->expects(self::once())
            ->method('searchData')
            ->with(
                new SearchData(
                    $parameters
                )
            )
            ->willReturn(
                new SearchDataResponse(
                    [
                        new SearchResponseCompanyData(),
                    ]
                )
            );
    }

    private function loginApiWithSessionId(string $sessionId): void
    {
        $this->apiClient
            ->method('login')
            ->willReturn(new LoginResponse($sessionId));

        $this->api->login();
    }
}
