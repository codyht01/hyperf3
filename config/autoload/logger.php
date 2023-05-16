<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
$formatter = [
    'class' => Monolog\Formatter\LineFormatter::class,
    'constructor' => [
    ],
];
$class = Monolog\Handler\RotatingFileHandler::class;
$type = 'filename';
return [
    'default' => [
        'handler' => [
            'class' => $class,
            'constructor' => [
                $type => BASE_PATH . '/runtime/logs/hyperf.log',
                'level' => \Monolog\Logger::DEBUG,
            ],
        ],
        'formatter' => $formatter,
    ],
    'error' => [
        'handler' => [
            'class' => $class,
            'constructor' => [
                $type => BASE_PATH . '/runtime/logs/error/error.log',
                'level' => \Monolog\Logger::DEBUG,
            ],
        ],
        'formatter' => $formatter,
    ],
    'stdout' => [
        'handler' => [
            'class' => $class,
            'constructor' => [
                $type => BASE_PATH . '/runtime/logs/stdout.log',
                'level' => \Monolog\Logger::INFO,
            ],
        ],
        'formatter' => $formatter,
    ],
];
