<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetFullReportResponse
{
    /**
     * @param array<int, array<string, string>> $report
     */
    public function __construct(public array $report = [])
    {
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function getReport(): array
    {
        return $this->report;
    }
}
