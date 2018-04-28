<?php

namespace GusApi\Tests;

use GusApi\Exception\InvalidReportTypeException;
use GusApi\Exception\InvalidSiloTypeException;
use GusApi\ReportTypeMapper;
use GusApi\SearchReport;
use PHPUnit\Framework\TestCase;

class ReportTypeMapperTest extends TestCase
{
    /**
     * @dataProvider reportTypeProvider
     *
     * @param string $type
     * @param int    $silo
     * @param string $reportName
     */
    public function testGetReportType(string $type, int $silo, string $reportName)
    {
        $report = $this->getSearchReport($type, $silo);
        $typeMapper = new ReportTypeMapper();

        $this->assertSame($reportName, $typeMapper->getReportType($report));
    }

    public function testThrowExceptionOnInvalidReportType()
    {
        $report = $this->getSearchReport('l', 1);
        $typeMapper = new ReportTypeMapper();
        $this->expectException(InvalidReportTypeException::class);
        $typeMapper->getReportType($report);
    }

    public function testThrowExceptionOnInvalidSiloType()
    {
        $report = $this->getSearchReport('f', 5);
        $typeMapper = new ReportTypeMapper();
        $this->expectException(InvalidSiloTypeException::class);
        $typeMapper->getReportType($report);
    }

    public function reportTypeProvider(): array
    {
        return [
            ['p', 1, 'PublDaneRaportPrawna'],
            ['p', 2, 'PublDaneRaportPrawna'],
            ['f', 1, 'PublDaneRaportDzialalnoscFizycznejCeidg'],
            ['f', 2, 'PublDaneRaportDzialalnoscFizycznejRolnicza'],
            ['f', 3, 'PublDaneRaportDzialalnoscFizycznejPozostala'],
            ['f', 4, 'PublDaneRaportDzialalnoscFizycznejWKrupgn'],
            ['lp', 1, 'PublDaneRaportLokalnaPrawnej'],
            ['lf', 1, 'PublDaneRaportLokalnaFizycznej'],
        ];
    }

    protected function getSearchReport(string $type, int $silo): SearchReport
    {
        $report = $this->createMock(SearchReport::class);
        $report->method('getType')->willReturn($type);
        $report->method('getSilo')->willReturn($silo);

        return $report;
    }
}
