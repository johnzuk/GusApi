<?php

namespace GusApi\Type\Response;

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
}
