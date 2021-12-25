<?php

declare(strict_types=1);

use League\OAuth2\Server\Grant;

return [
    'authentication' => [
        //'private_key' => dirname(__DIR__) . '/../data/oauth/private.key',
        'private_key' => [
               'key_or_path' => __DIR__ . '/../../data/oauth/private.key',
               'key_permissions_check' => false,
           ],
        'public_key' => dirname(__DIR__) . '/../../data/oauth/public.key',
        'encryption_key' => require dirname(__DIR__) . '/../data/oauth/encryption.key',

        'access_token_expire' => 'P1D',
        'refresh_token_expire' => 'P1M',
        'auth_code_expire' => 'PT10M',

        // 'pdo' => [
        //     'dsn' => sprintf(
        //         'pgsql:dbname=%s;host=%s',
        //         false !== getenv('PGSQL_DB_NAME') ? getenv('PGSQL_DB_NAME') : 'mezzio',
        //         false !== getenv('PGSQL_DB_HOST') ? getenv('PGSQL_DB_HOST') : '127.0.0.1'
        //     ),
        //     'username' => false !== getenv('PGSQL_DB_USER') ? getenv('PGSQL_DB_USER') : 'postgres',
        //     'password' => false !== getenv('PGSQL_DB_PASS') ? getenv('PGSQL_DB_PASS') : 'Passw0rd0',
        // ],

        'grants' => [
            Grant\ClientCredentialsGrant::class => Grant\ClientCredentialsGrant::class,
            Grant\PasswordGrant::class => Grant\PasswordGrant::class,
            Grant\AuthCodeGrant::class => Grant\AuthCodeGrant::class,
            Grant\ImplicitGrant::class => Grant\ImplicitGrant::class,
            Grant\RefreshTokenGrant::class => Grant\RefreshTokenGrant::class,
        ],
    ],
];