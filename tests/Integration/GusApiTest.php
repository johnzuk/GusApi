<?php

namespace GusApi\Tests\Integration;

use GusApi\Exception\NotFoundException;
use GusApi\GusApi;
use GusApi\SearchReport;
use PHPUnit\Framework\TestCase;

/**
 * @group risky
 */
class GusApiTest extends TestCase
{
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

    public function testGetByInvalidNip()
    {
        $this->expectException(NotFoundException::class);
        self::$apiClient->getByNip('0123456789');
    }

    public function testGetExampleCompanyByRegon()
    {
        $result = self::$apiClient->getByRegon('610188201');
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    public function testGetExampleCompanyByKrs()
    {
        $result = self::$apiClient->getByKrs('0000028860');
        $this->assertCount(1, $result);
        $this->assertValidExampleCompany($result[0]);
    }

    protected function assertValidExampleCompany(SearchReport $report)
    {
        $this->assertSame('61018820100000', $report->getRegon());
        $this->assertSame('61018820100000', $report->getRegon14());
        $this->assertSame('POLSKI KONCERN NAFTOWY ORLEN SPÓŁKA AKCYJNA', $report->getName());
        $this->assertSame('MAZOWIECKIE', $report->getProvince());
        $this->assertSame('m. Płock', $report->getDistrict());
        $this->assertSame('M. Płock', $report->getCommunity());
        $this->assertSame('Płock', $report->getCity());
        $this->assertSame('09-411', $report->getZipCode());
        $this->assertSame('ul. Test-Wilcza', $report->getStreet());
        $this->assertSame(SearchReport::TYPE_JURIDICAL_PERSON, $report->getType());
        $this->assertSame('6', $report->getSilo());
    }
}
