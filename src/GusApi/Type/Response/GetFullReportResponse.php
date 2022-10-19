<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetFullReportResponse
{
    /**
     * @var array<int, array<string, string>>
     */
    public array $report;

    /**
     * @param array<int, array<string, string>> $report
     */
    public function __construct(array $report = [])
    {
        $this->report = $report;
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function getReport(): array
    {
        return $this->report;
    }
}
