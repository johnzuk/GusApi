<?php

namespace GusApi\Type\Response;

class GetBulkReportResponseRaw
{
    /**
     * @var string
     */
    public $DanePobierzRaportZbiorczyResult;

    /**
     * @param string $DanePobierzRaportZbiorczyResult
     */
    public function __construct(string $DanePobierzRaportZbiorczyResult)
    {
        $this->DanePobierzRaportZbiorczyResult = $DanePobierzRaportZbiorczyResult;
    }

    /**
     * @return string
     */
    public function getDanePobierzRaportZbiorczyResult(): string
    {
        return $this->DanePobierzRaportZbiorczyResult;
    }
}
