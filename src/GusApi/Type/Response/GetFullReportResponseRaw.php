<?php

namespace GusApi\Type\Response;

class GetFullReportResponseRaw
{
    /**
     * @var string
     */
    public $DanePobierzPelnyRaportResult = '';

    /**
     * @param string $DanePobierzPelnyRaportResult
     */
    public function __construct(string $DanePobierzPelnyRaportResult)
    {
        $this->DanePobierzPelnyRaportResult = $DanePobierzPelnyRaportResult;
    }

    /**
     * @return string
     */
    public function getDanePobierzPelnyRaportResult(): string
    {
        return $this->DanePobierzPelnyRaportResult;
    }
}
