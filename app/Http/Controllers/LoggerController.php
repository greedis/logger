<?php

namespace App\Http\Controllers;

use App\Services\Logger\LoggerFactory;
use Illuminate\Http\Request;

class LoggerController extends Controller
{
    public function log(Request $request)
    {
        $message = $request->input('message', 'Default log message');
        $logger = LoggerFactory::create(config('logger.default_logger'));
        $logger->send($message);
    }

    public function logTo(Request $request, string $type)
    {
        $message = $request->input('message', 'Default log message');
        $logger = LoggerFactory::create($type);
        $logger->send($message);
    }

    public function logToAll(Request $request)
    {
        $message = $request->input('message', 'Default log message');
        $loggers = ['email', 'database', 'file'];
        foreach ($loggers as $type) {
            $logger = LoggerFactory::create($type);
            $logger->send($message);
        }
    }
}
