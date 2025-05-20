<?php

namespace App\Infra;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerFactory {
    public static function create(string $channel = 'app'): Logger {
        $logger = new Logger($channel);
        $logger->pushHandler(new StreamHandler(__DIR__ . 'logs/app.log', Logger::DEBUG));
        return $logger;
    }
}
