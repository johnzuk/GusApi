<?php
namespace GusApi\Environment;

/**
 * Interface EnvironmentInterface
 * @package GusApi\Environment
 */
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
