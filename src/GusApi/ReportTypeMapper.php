<?php
namespace GusApi;
use GusApi\Exception\InvalidReportTypeException;
use GusApi\Exception\InvalidSidException;
use GusApi\Exception\InvalidSiloTypeException;

/**
 * Class ReportTypeMapper
 * @package GusApi
 */
class ReportTypeMapper
{
    /**
     * @param SearchReport $report
     * @throws InvalidReportTypeException
     * @throws InvalidSiloTypeException
     * @return string
     */
    public function getReportType(SearchReport $report)
    {
        $method = 'type'.ucfirst($report->getType());

        if (!method_exists($this, $method)) {
            throw new InvalidReportTypeException(sprintf("Invalid report type: %s"), $report->getType());
        }

        return call_user_func([$this, $method], $report->getSilo());
    }

    /**
     * @param int $silo
     * @return string
     */
    protected function typeP($silo)
    {
        return ReportTypes::REPORT_PUBLIC_LAW;
    }

    /**
     * @param int $silo
     * @return mixed
     */
    protected function typeF($silo)
    {
        $siloMapper = [
            1 => ReportTypes::REPORT_ACTIVITY_PHYSIC_CEIDG,
            2 => ReportTypes::REPORT_ACTIVITY_PHYSIC_AGRO,
            3 => ReportTypes::REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC,
            4 => ReportTypes::REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC,
        ];

        if (!key_exists($silo, $siloMapper)) {
            throw new InvalidSidException(sprintf("Invalid silo type: %s", $silo));
        }

        return $siloMapper[$silo];
    }

    /**
     * @param int $silo
     * @return string
     */
    protected function typeLp($silo)
    {
        return ReportTypes::REPORT_LOCAL_LAW_PUBLIC;
    }

    /**
     * @param $silo
     * @return string
     */
    protected function typeLf($silo)
    {
        return ReportTypes::REPORT_LOCAL_PHYSIC_PUBLIC;
    }
}
