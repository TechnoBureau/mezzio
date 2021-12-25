<?php
//use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\DBAL\Driver\PDO\PgSQL\Driver;
return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'auto_generate_proxy_classes' => false,
                'proxy_dir'                   => 'data/proxies',
                'sql_logger' => 'my_sql_logger',
                //'naming_strategy'             => UnderscoreNamingStrategy::class,
            ],
        ],
        'connection' => [
            'orm_default' => [
                'driver_class' => Driver::class,
                'params'       => [
                    'host'    => '127.0.0.1',
                    //'charset' => 'utf8mb4',
                    'options' => [
                        1002 => 'SET NAMES utf8',
                    ],
                    'serverVersion' => '10.5.12-MariaDB', // setting this lets the CLI work without a live DB connection (e.g. in CI)
                ],
            ],
        ],
        'migrations' => [
            'orm_default' => [
                'migrations_paths' => [
                    'Carlease' => 'data/migrations',
                ],
            ],
        ],
    ],
];