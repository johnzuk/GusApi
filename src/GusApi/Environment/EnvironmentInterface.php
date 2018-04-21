<?php

namespace GusApi\Environment;

interface EnvironmentInterface
{
    /**
     * @return string
     */
    public function getWSDLUrl(): string;

    /**
     * @return string
     */
    public function getServerLocationUrl(): string;
}
