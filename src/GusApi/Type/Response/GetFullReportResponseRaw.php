<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetFullReportResponseRaw
{
    public string $DanePobierzPelnyRaportResult = '';

    public function __construct(string $DanePobierzPelnyRaportResult)
    {
        $this->DanePobierzPelnyRaportResult = $DanePobierzPelnyRaportResult;
    }

    public function getDanePobierzPelnyRaportResult(): string
    {
        return $this->DanePobierzPelnyRaportResult;
    }
}
