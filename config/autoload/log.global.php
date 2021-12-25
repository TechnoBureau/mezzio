<?php
use Laminas\Log\Formatter\FormatterInterface;
use Laminas\Log\Logger;
#use Doctrine\DBAL\Logging\SQLLogger as Logger;
#use Doctrine\DBAL\Logging\SQLLogger;
use Laminas\Log\Formatter\Simple;

return [
    'log' => [
        'MyLogger' => [
            'writers' => [
                'stream' => [
                    'name' => 'stream',
                    'priority' => 1,
                    'options' => [
                        'stream' => 'data/logs/sql.log',
                        'formatter' => [
                            'name' => Simple::class,
                            'options' => [
                                'format' => '%timestamp% %priorityName% (%priority%): %message%',
                                'dateTimeFormat' => FormatterInterface::DEFAULT_DATETIME_FORMAT,
                            ],
                        ],
                        'filters' => [
                            'priority' => [
                                'name' => 'priority',
                                'options' => [
                                    'operator' => '<=',
                                    'priority' => Logger::DEBUG,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];