<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetFullReportResponseRaw
{
    public function __construct(public string $DanePobierzPelnyRaportResult)
    {
    }

    public function getDanePobierzPelnyRaportResult(): string
    {
        return $this->DanePobierzPelnyRaportResult;
    }
}
