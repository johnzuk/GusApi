<?php

declare(strict_types=1);

namespace GusApi\Client;

interface BuilderInterface
{
    public function build(): GusApiClient;
}
