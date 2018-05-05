<?php

namespace GusApi\Tests;

use GusApi\SearchReport;
use GusApi\Type\Response\SearchResponseCompanyData;

trait ExampleCompanyTrait
{
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
        $this->assertSame(6, $report->getSilo());
    }

    protected function getExampleResponseData(): SearchResponseCompanyData
    {
        $responseData = $this->createMock(SearchResponseCompanyData::class);
        $responseData->method('getRegon')->willReturn('61018820100000');
        $responseData->method('getNazwa')->willReturn('POLSKI KONCERN NAFTOWY ORLEN SPÓŁKA AKCYJNA');
        $responseData->method('getWojewodztwo')->willReturn('MAZOWIECKIE');
        $responseData->method('getPowiat')->willReturn('m. Płock');
        $responseData->method('getGmina')->willReturn('M. Płock');
        $responseData->method('getMiejscowosc')->willReturn('Płock');
        $responseData->method('getKodPocztowy')->willReturn('09-411');
        $responseData->method('getUlica')->willReturn('ul. Test-Wilcza');
        $responseData->method('getTyp')->willReturn('p');
        $responseData->method('getSilosID')->willReturn('6');

        return $responseData;
    }
}
