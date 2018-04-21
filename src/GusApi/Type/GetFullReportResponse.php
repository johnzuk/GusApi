<?php

namespace GusApi\Type;

class GetFullReportResponse
{
    /**
     * @var \SimpleXMLElement
     */
    public $report;

    /**
     * GetFullReportResponse constructor.
     *
     * @param \SimpleXMLElement $report
     */
    public function __construct(\SimpleXMLElement $report)
    {
        $this->report = $report;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getReport(): \SimpleXMLElement
    {
        return $this->report;
    }

    /**
     * @param \SimpleXMLElement $report
     */
    public function setReport(\SimpleXMLElement $report): void
    {
        $this->report = $report;
    }
}
