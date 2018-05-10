<?php

namespace GusApi\Type\Response;

class SearchResponseRaw
{
    /**
     * @var string
     */
    protected $DaneSzukajResult = '';

    /**
     * @param string $DaneSzukajResult
     */
    public function __construct(string $DaneSzukajResult)
    {
        $this->DaneSzukajResult = $DaneSzukajResult;
    }

    /**
     * @return string
     */
    public function getDaneSzukajResult(): string
    {
        return $this->DaneSzukajResult;
    }
}
