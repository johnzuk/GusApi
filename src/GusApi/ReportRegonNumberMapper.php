<?php

namespace GusApi;

use GusApi\Exception\InvalidReportTypeException;

class ReportRegonNumberMapper
{
    /**
     * @param SearchReport $report
     * @param string       $reportName
     *
     * @throws InvalidReportTypeException
     *
     * @return string
     */
    public static function getRegonNumberByReportName(SearchReport $report, string $reportName): string
    {
        if (!\in_array($reportName, ReportTypes::REPORTS, true)) {
            throw new InvalidReportTypeException(
                \sprintf(
                    'Invalid report type: "%s", use one of allowed type: (%s)',
                    $reportName,
                    \implode(', ', ReportTypes::REPORTS)
                )
            );
        }

        if (\in_array($reportName, ReportTypes::REGON_9_REPORTS, true)) {
            return $report->getRegon();
        }

        return $report->getRegon14();
    }
}
