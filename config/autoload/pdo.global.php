<?php

declare(strict_types=1);

return [
    'authentication' => [
        'pdo' => [
            'dsn' => sprintf(
                'pgsql:dbname=%s;host=%s',
                false !== getenv('PGSQL_DB_NAME') ? getenv('PGSQL_DB_NAME') : 'mezzio',
                false !== getenv('PGSQL_DB_HOST') ? getenv('PGSQL_DB_HOST') : '127.0.0.1'
            ),
            'username' => false !== getenv('PGSQL_DB_USER') ? getenv('PGSQL_DB_USER') : 'postgres',
            'password' => false !== getenv('PGSQL_DB_PASS') ? getenv('PGSQL_DB_PASS') : 'Passw0rd0',
            'table' => 'auth_user',
            'field' => [
                'identity' => 'username',
                'password' => 'password',
            ],

            'sql_get_roles' => "SELECT 'admin' FROM auth_user WHERE username = :identity"
        ],
    ],
];