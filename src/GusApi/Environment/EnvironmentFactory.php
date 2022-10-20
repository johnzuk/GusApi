<?php

declare(strict_types=1);

namespace GusApi\Environment;

use GusApi\Exception\InvalidEnvironmentNameException;

final class EnvironmentFactory
{
    public static function create(string $environment): EnvironmentInterface
    {
        if ('prod' === $environment) {
            return new ProdEnvironment();
        }

        if ('dev' === $environment) {
            return new DevEnvironment();
        }

        throw new InvalidEnvironmentNameException(sprintf('Invalid environment %s', $environment));
    }
}
