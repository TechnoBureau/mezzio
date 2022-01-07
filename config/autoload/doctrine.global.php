<?php
use Doctrine\DBAL\Driver\PDO\PgSQL\Driver;
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driver_class' => Driver::class,
                'params'       => [
                    'host'    => '127.0.0.1',
                    //'charset' => 'utf8mb4',
                    'options' => [
                        1002 => 'SET NAMES utf8',
                    ],
                    //'serverVersion' => '10.5.12-MariaDB', // setting this lets the CLI work without a live DB connection (e.g. in CI)
                ],
            ],
        ],
    ],
];