<?php

declare(strict_types=1);

namespace App;

use Doctrine\Migrations\Configuration\Migration\ConfigurationLoader;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Ramsey\Uuid\Doctrine\UuidType;
use Roave\PsrContainerDoctrine\CacheFactory;
use Roave\PsrContainerDoctrine\ConfigurationFactory;
use Roave\PsrContainerDoctrine\ConnectionFactory;
use Roave\PsrContainerDoctrine\DriverFactory;
use Roave\PsrContainerDoctrine\EntityManagerFactory;
use Roave\PsrContainerDoctrine\EventManagerFactory;
use Roave\PsrContainerDoctrine\Migrations\CommandFactory;
use Roave\PsrContainerDoctrine\Migrations\ConfigurationLoaderFactory;
use Roave\PsrContainerDoctrine\Migrations\DependencyFactoryFactory;

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
            'laminas-cli'  => $this->laminasCli(),
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
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories' => [
                 Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                'doctrine.cache.orm_default'          => CacheFactory::class,
                'doctrine.connection.orm_default'     => ConnectionFactory::class,
                'doctrine.configuration.orm_default'  => ConfigurationFactory::class,
                'doctrine.driver.orm_default'         => DriverFactory::class,
                'doctrine.entity_manager.orm_default' => EntityManagerFactory::class,
                'doctrine.event_manager.orm_default'  => EventManagerFactory::class,

                ConfigurationLoader::class => ConfigurationLoaderFactory::class,
                DependencyFactory::class   => DependencyFactoryFactory::class,

                CurrentCommand::class      => CommandFactory::class,
                DiffCommand::class         => CommandFactory::class,
                DumpSchemaCommand::class   => CommandFactory::class,
                ExecuteCommand::class      => CommandFactory::class,
                GenerateCommand::class     => CommandFactory::class,
                LatestCommand::class       => CommandFactory::class,
                ListCommand::class         => CommandFactory::class,
                MigrateCommand::class      => CommandFactory::class,
                RollupCommand::class       => CommandFactory::class,
                SyncMetadataCommand::class => CommandFactory::class,
                StatusCommand::class       => CommandFactory::class,
                UpToDateCommand::class     => CommandFactory::class,
                VersionCommand::class      => CommandFactory::class,
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
     * Get laminas CLI configuration.
     *
     * @return array<string, mixed>
     */
    private function laminasCli(): array
    {
        return [
            'commands' => [
                'migrations:current'               => CurrentCommand::class,
                'migrations:diff'                  => DiffCommand::class,
                'migrations:dump-schema'           => DumpSchemaCommand::class,
                'migrations:execute'               => ExecuteCommand::class,
                'migrations:generate'              => GenerateCommand::class,
                'migrations:latest'                => LatestCommand::class,
                'migrations:list'                  => ListCommand::class,
                'migrations:migrate'               => MigrateCommand::class,
                'migrations:rollup'                => RollupCommand::class,
                'migrations:sync-metadata-storage' => SyncMetadataCommand::class,
                'migrations:status'                => StatusCommand::class,
                'migrations:up-to-date'            => UpToDateCommand::class,
                'migrations:version'               => VersionCommand::class,
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
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
