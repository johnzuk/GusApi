<?php

declare(strict_types=1);

namespace GusApi;

use GusApi\Exception\InvalidReportTypeException;

class ReportRegonNumberMapper
{
    /**
     * @throws InvalidReportTypeException
     */
    public static function getRegonNumberByReportName(SearchReport $report, string $reportName): string
    {
        if (!\in_array($reportName, ReportTypes::REPORTS, true)) {
            throw new InvalidReportTypeException(sprintf('Invalid report type: "%s", use one of allowed type: (%s)', $reportName, implode(', ', ReportTypes::REPORTS)));
        }

        if (\in_array($reportName, ReportTypes::REGON_9_REPORTS, true)) {
            return $report->getRegon();
        }

        return $report->getRegon14();
    }
}
