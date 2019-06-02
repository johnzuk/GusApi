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
    public function testGetReportType(string $type, int $silo, string $reportName): void
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
            ['p', 1, 'BIR11OsPrawna'],
            ['p', 2, 'BIR11OsPrawna'],
            ['f', 1, 'BIR11OsFizycznaDzialalnoscCeidg'],
            ['f', 2, 'BIR11OsFizycznaDzialalnoscRolnicza'],
            ['f', 3, 'BIR11OsFizycznaDzialalnoscPozostala'],
            ['f', 4, 'BIR11OsFizycznaDzialalnoscSkreslonaDo20141108'],
            ['lp', 1, 'BIR11JednLokalnaOsPrawnej'],
            ['lf', 1, 'BIR11OsFizycznaListaJednLokalnych'],
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
