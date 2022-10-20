<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetBulkReportResponseRaw
{
    public function __construct(public string $DanePobierzRaportZbiorczyResult)
    {
    }

    public function getDanePobierzRaportZbiorczyResult(): string
    {
        return $this->DanePobierzRaportZbiorczyResult;
    }
}
