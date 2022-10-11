<?php

declare(strict_types=1);

namespace GusApi\Environment;

interface EnvironmentInterface
{
    public function getWSDLUrl(): string;

    public function getServerLocationUrl(): string;
}
