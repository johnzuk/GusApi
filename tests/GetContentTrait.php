<?php

declare(strict_types=1);

namespace GusApi\Tests;

use RuntimeException;

trait GetContentTrait
{
    public static function getContent(string $filename): string
    {
        $content = file_get_contents($filename);
        if ($content === false) {
            throw new RuntimeException(sprintf('Unable to load test file %s', $filename));
        }

        return $content;
    }
}
