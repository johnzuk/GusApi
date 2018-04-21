<?php

namespace GusApi\Type;

/**
 * Class GetFullReportResponseRaw
 *
 * @package GusApi\Type
 */
class GetFullReportResponseRaw
{
    /**
     * @var string
     */
    public $DanePobierzPelnyRaportResult = '';

    /**
     * GetFullReportResponseRaw constructor.
     *
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

    /**
     * @param string $DanePobierzPelnyRaportResult
     */
    public function setDanePobierzPelnyRaportResult(string $DanePobierzPelnyRaportResult): void
    {
        $this->DanePobierzPelnyRaportResult = $DanePobierzPelnyRaportResult;
    }
}
