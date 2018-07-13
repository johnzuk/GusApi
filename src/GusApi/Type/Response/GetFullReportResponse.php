<?php

namespace GusApi\Type\Response;

class GetFullReportResponse
{
    /**
     * @var array[]
     */
    public $report;

    /**
     * GetFullReportResponse constructor.
     *
     * @param array[] $report
     */
    public function __construct(array $report = [])
    {
        $this->report = $report;
    }

    /**
     * @return array[]
     */
    public function getReport(): array
    {
        return $this->report;
    }
}
