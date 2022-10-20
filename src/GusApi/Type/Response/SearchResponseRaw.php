<?php

declare(strict_types=1);

namespace GusApi\Type\Response;

class SearchResponseRaw
{
    public function __construct(public string $DaneSzukajPodmiotyResult)
    {
    }

    public function getDaneSzukajPodmiotyResult(): string
    {
        return $this->DaneSzukajPodmiotyResult;
    }
}
