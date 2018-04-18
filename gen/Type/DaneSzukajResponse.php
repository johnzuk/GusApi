<?php

namespace GusApi\Type;

class DaneSzukajResponse
{

    /**
     * @var string
     */
    private $DaneSzukajResult;

    /**
     * @return string
     */
    public function getDaneSzukajResult()
    {
        return $this->DaneSzukajResult;
    }

    /**
     * @param string $DaneSzukajResult
     * @return DaneSzukajResponse
     */
    public function withDaneSzukajResult($DaneSzukajResult)
    {
        $new = clone $this;
        $new->DaneSzukajResult = $DaneSzukajResult;

        return $new;
    }


}

