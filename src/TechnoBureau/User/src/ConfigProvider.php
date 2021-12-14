<?php

declare(strict_types=1);

namespace TechnoBureau\User;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Ramsey\Uuid\Doctrine\UuidType;
use Roave\PsrContainerDoctrine\DriverFactory;
use Roave\PsrContainerDoctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

use Mezzio\Application;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'doctrine'     => $this->doctrine(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'aliases' => [
                EntityManager::class => 'doctrine.entity_manager.orm_default',
            ],
            'invokables' => [
            ],
            'factories' => [
                Handler\UserHandler::class => Handler\UserHandlerFactory::class,
                'doctrine.driver.orm_default'         => DriverFactory::class,
                'doctrine.entity_manager.orm_default' => EntityManagerFactory::class,
            ],
        ];
    }

    /**
     * Get doctrine configuration.
     *
     * @return array<string, mixed>
     */
    private function doctrine(): array
    {
        return [
            'configuration' => [
                'orm_default' => [
                    'types' => [
                        UuidType::NAME => UuidType::class,
                    ],
                ],
            ],
            'driver' => [
                __NAMESPACE__ . '_driver' => [
                    'class' => XmlDriver::class,
                    'paths' => [
                        dirname(__DIR__) . '/data/orm',
                    ],
                ],
                'orm_default' => [
                    'class'   => MappingDriverChain::class,
                    'drivers' => [
                        __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                    ],
                ],
            ],
            'migrations' => [
                'orm_default' => [
                    'table_storage' => [
                        'table_name' => 'migrations',
                    ],
                    'migrations_paths'        => [],
                    'all_or_nothing'          => true,
                    'check_database_platform' => true,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'user' => [__DIR__ . '/templates/user'],
            ],
        ];
    }
    public function registerRoutes(Application $app, string $basePath = '/user'): void
    {
        $app->get($basePath . '[/]', Handler\UserHandler::class, 'user');

    }
}
