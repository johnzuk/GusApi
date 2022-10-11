<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class GetBulkReportResponseRaw
{
    /**
     * @var string
     */
    public $DanePobierzRaportZbiorczyResult;

    public function __construct(string $DanePobierzRaportZbiorczyResult)
    {
        $this->DanePobierzRaportZbiorczyResult = $DanePobierzRaportZbiorczyResult;
    }

    public function getDanePobierzRaportZbiorczyResult(): string
    {
        return $this->DanePobierzRaportZbiorczyResult;
    }
}
