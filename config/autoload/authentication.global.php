<?php

declare(strict_types=1);

use Mezzio\Authentication\UserRepositoryInterface;
use Mezzio\Authentication\UserRepository\PdoDatabase;
use Mezzio\Authorization\AuthorizationInterface;
use Mezzio\Authorization\Acl\LaminasAcl;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\Session\PhpSessionFactory;

return [
    'dependencies' => [
        'aliases' => [
            UserRepositoryInterface::class => PdoDatabase::class,
            AuthorizationInterface::class  => LaminasAcl::class,
        ],
        'factories' => [
            AuthenticationInterface::class => PhpSessionFactory::class,
        ]
    ],

    'authentication' => [
        'redirect' => '/login',
        'username' => 'username',
        'password' => 'password',
        'remember-me-seconds' => 604800,
    ],
];