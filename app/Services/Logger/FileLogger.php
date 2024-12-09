<?php

namespace App\Services\Logger;

use Illuminate\Support\Facades\Storage;

class FileLogger implements LoggerInterface
{
    private string $type = 'file';

    public function send(string $message): void
    {
        $filePath = 'logs.txt';

        if (!Storage::exists($filePath)) {
            Storage::put($filePath, "=== Log File Created ===\n");
        }

        Storage::append($filePath, $message);
        echo "File log saved: {$message}\n";
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        $this->send($message);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
