<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class SearchResponseRaw
{
    /**
     * @var string
     */
    protected $DaneSzukajPodmiotyResult = '';

    public function __construct(string $DaneSzukajPodmiotyResult)
    {
        $this->DaneSzukajPodmiotyResult = $DaneSzukajPodmiotyResult;
    }

    public function getDaneSzukajPodmiotyResult(): string
    {
        return $this->DaneSzukajPodmiotyResult;
    }
}
