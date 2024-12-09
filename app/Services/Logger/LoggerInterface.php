<?php

namespace App\Services\Logger;

interface LoggerInterface
{
    public function send(string $message): void;

    public function sendByLogger(string $message, string $loggerType): void;

    public function getType(): string;

    public function setType(string $type): void;
}
