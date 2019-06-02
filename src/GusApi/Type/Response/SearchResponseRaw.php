<?php

namespace GusApi\Type\Response;

class SearchResponseRaw
{
    /**
     * @var string
     */
    protected $DaneSzukajPodmiotyResult = '';

    /**
     * @param string $DaneSzukajPodmiotyResult
     */
    public function __construct(string $DaneSzukajPodmiotyResult)
    {
        $this->DaneSzukajPodmiotyResult = $DaneSzukajPodmiotyResult;
    }

    /**
     * @return string
     */
    public function getDaneSzukajPodmiotyResult(): string
    {
        return $this->DaneSzukajPodmiotyResult;
    }
}
