<?php

namespace App\Services\Logger;

use App\Services\Logger\LoggerInterface;
use Illuminate\Support\Facades\DB;

class DatabaseLogger implements LoggerInterface
{
    private string $type = 'database';

    public function send(string $message): void
    {
        DB::table('logs')->insert(['message' => $message, 'created_at' => now()]);
        echo "Database log saved: {$message}\n";
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
