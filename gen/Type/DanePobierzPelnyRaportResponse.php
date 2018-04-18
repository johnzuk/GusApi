<?php

namespace GusApi\Type;

class DanePobierzPelnyRaportResponse
{

    /**
     * @var string
     */
    private $DanePobierzPelnyRaportResult;

    /**
     * @return string
     */
    public function getDanePobierzPelnyRaportResult()
    {
        return $this->DanePobierzPelnyRaportResult;
    }

    /**
     * @param string $DanePobierzPelnyRaportResult
     * @return DanePobierzPelnyRaportResponse
     */
    public function withDanePobierzPelnyRaportResult($DanePobierzPelnyRaportResult)
    {
        $new = clone $this;
        $new->DanePobierzPelnyRaportResult = $DanePobierzPelnyRaportResult;

        return $new;
    }


}

