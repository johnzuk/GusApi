<?php

namespace GusApi\Environment;

use GusApi\Exception\InvalidEnvironmentNameException;

class EnvironmentFactory
{
    /**
     * @param string $environment
     *
     * @return EnvironmentInterface
     */
    public static function create(string $environment): EnvironmentInterface
    {
        if ('prod' === $environment) {
            return new ProdEnvironment();
        }
        if ('dev' === $environment) {
            return new DevEnvironment();
        }

        throw new InvalidEnvironmentNameException(\sprintf('Invalid environment %s', $environment));
    }
}
