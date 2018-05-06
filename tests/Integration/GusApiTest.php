<?php

namespace GusApi\Tests\Integration;

use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use GusApi\SearchReport;
use GusApi\Tests\ExampleCompanyTrait;
use PHPUnit\Framework\TestCase;

/**
 * @group risky
 */
class GusApiTest extends TestCase
{
    use ExampleCompanyTrait;

    /**
     * @var GusApi
     */
    protected static $apiClient;

    public static function setUpBeforeClass()
    {
        self::$apiClient = new GusApi('abcde12345abcde12345', 'dev');
        self::$apiClient->login();
    }

    public function testGetExampleCompanyByNip()
    {
        $result = self::$apiClient->getByNip('7740001454');
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetExampleCompanyByNips()
    {
        $result = self::$apiClient->getByNips(['7740001454']);
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetByInvalidNipAndGetMessage()
    {
        $this->expectException(NotFoundException::class);

        try {
            self::$apiClient->getByNip('0123456789');
        } finally {
            $this->assertSame(1, self::$apiClient->getSessionStatus());
            $this->assertSame('Nie znaleziono podmiotów.', self::$apiClient->getMessage());
            $this->assertSame(4, self::$apiClient->getMessageCode());
        }
    }

    public function testGetExampleCompanyByRegon()
    {
        $result = self::$apiClient->getByRegon('610188201');
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetExampleCompanyByRegons()
    {
        $this->markTestSkipped('API probably does not work.');
        $result = self::$apiClient->getByRegons9(['610188201']);
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetExampleCompanyByKrs()
    {
        $result = self::$apiClient->getByKrs('0000028860');
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetExampleCompanyByKrses()
    {
        $result = self::$apiClient->getByKrses(['0000028860']);
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetStatus()
    {
        $this->assertInstanceOf(\DateTime::class, self::$apiClient->dataStatus());
        $this->assertSame(1, self::$apiClient->serviceStatus());
        $this->assertSame('Usluga dostepna', self::$apiClient->serviceMessage());
    }

    public function testGetFullReport()
    {
        $report = $this->createMock(SearchReport::class);
        $report->method('getRegon14')->willReturn('61018820100000');
        $result = self::$apiClient->getFullReport($report, ReportTypes::REPORT_PUBLIC_LAW);
        $this->assertEquals('61018820100000', $result->praw_regon14);
        $this->assertEquals('1993-07-01', $result->praw_dataPowstania);
    }

    public function testInvalidKey()
    {
        $apiClient = new GusApi('abcde12345abcde12345', 'dev');
        $apiClient->setUserKey('invalid-key');
        $this->assertSame('invalid-key', $apiClient->getUserKey());
        $this->expectExceptionObject(new InvalidUserKeyException('User key \'invalid-key\' is invalid'));
        $apiClient->login();
    }

    public function testLoginLogout()
    {
        $apiClient = new GusApi('abcde12345abcde12345', 'dev');
        $this->assertTrue($apiClient->login());
        $this->assertNotEmpty($apiClient->getSessionId());
        $this->assertTrue($apiClient->isLogged());
        $this->assertTrue($apiClient->logout());
        $this->assertFalse($apiClient->isLogged());
    }
}
