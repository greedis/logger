<?php

namespace App\Services\Logger;

use InvalidArgumentException;

class LoggerFactory
{
    public static function create(string $type): LoggerInterface
    {
        return match ($type) {
            'email' => new EmailLogger(),
            'database' => new DatabaseLogger(),
            'file' => new FileLogger(),
            default => throw new InvalidArgumentException("Logger type '{$type}' is not supported."),
        };
    }
}
