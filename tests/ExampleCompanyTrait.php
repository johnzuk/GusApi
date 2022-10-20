<?php

declare(strict_types=1);

namespace GusApi\Tests;

use GusApi\SearchReport;
use GusApi\Type\Response\SearchResponseCompanyData;

trait ExampleCompanyTrait
{
    protected function assertValidExampleCompany(SearchReport $report, bool $checkPostCity = true): void
    {
        $this->assertSame('610188201', $report->getRegon());
        $this->assertSame('61018820100000', $report->getRegon14());
        $this->assertSame('7740001454', $report->getNip());
        $this->assertSame('', $report->getNipStatus());
        $this->assertSame('POLSKI KONCERN NAFTOWY ORLEN SPÓŁKA AKCYJNA', $report->getName());
        $this->assertSame('MAZOWIECKIE', $report->getProvince());
        $this->assertSame('m. Płock', $report->getDistrict());
        $this->assertSame('M. Płock', $report->getCommunity());
        $this->assertSame('Płock', $report->getCity());
        $this->assertSame('09-411', $report->getZipCode());
        $this->assertSame('ul. Test-Wilcza', $report->getStreet());
        $this->assertSame('7', $report->getPropertyNumber());
        $this->assertSame('', $report->getApartmentNumber());
        $this->assertSame(SearchReport::TYPE_JURIDICAL_PERSON, $report->getType());
        $this->assertSame(6, $report->getSilo());
        $this->assertSame('', $report->getActivityEndDate());
        if ($checkPostCity) {
            $this->assertSame('Płock', $report->getPostCity());
        }
    }

    protected function getExampleResponseData(): SearchResponseCompanyData
    {
        $responseData = $this->createMock(SearchResponseCompanyData::class);
        $responseData->method('getRegon')->willReturn('610188201');
        $responseData->method('getNip')->willReturn('7740001454');
        $responseData->method('getStatusNip')->willReturn('');
        $responseData->method('getNazwa')->willReturn('POLSKI KONCERN NAFTOWY ORLEN SPÓŁKA AKCYJNA');
        $responseData->method('getWojewodztwo')->willReturn('MAZOWIECKIE');
        $responseData->method('getPowiat')->willReturn('m. Płock');
        $responseData->method('getGmina')->willReturn('M. Płock');
        $responseData->method('getMiejscowosc')->willReturn('Płock');
        $responseData->method('getKodPocztowy')->willReturn('09-411');
        $responseData->method('getUlica')->willReturn('ul. Test-Wilcza');
        $responseData->method('getNrNieruchomosci')->willReturn('7');
        $responseData->method('getNrLokalu')->willReturn('');
        $responseData->method('getTyp')->willReturn('p');
        $responseData->method('getSilosID')->willReturn(6);
        $responseData->method('getDataZakonczeniaDzialalnosci')->willReturn('');
        $responseData->method('getMiejscowoscPoczty')->willReturn('Płock');

        return $responseData;
    }
}
