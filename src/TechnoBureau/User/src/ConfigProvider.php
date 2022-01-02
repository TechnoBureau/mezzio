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
use Mezzio\Authentication;

use Mezzio\Authentication\OAuth2;
use Mezzio\Session\SessionMiddleware;
use Mezzio\Csrf\CsrfMiddleware;

use TechnoBureau\User\Handler\HomePageHandler;
use TechnoBureau\User\Handler\HomePageHandlerFactory;
use TechnoBureau\User\Handler\AdminPageHandler;
use TechnoBureau\User\Handler\AdminPageHandlerFactory;
use TechnoBureau\User\Handler\LoginPageHandler;
use TechnoBureau\User\Handler\LoginPageHandlerFactory;
use TechnoBureau\User\Handler\LogoutHandler;
use TechnoBureau\User\Handler\PingHandler;
use TechnoBureau\User\Middleware\PrgMiddleware;
use TechnoBureau\User\Middleware\UserMiddleware;
use TechnoBureau\User\Middleware\UserMiddlewareFactory;
use TechnoBureau\User\View\Helper\Flash;
use TechnoBureau\User\View\Helper\GetRole;
use TechnoBureau\User\View\Helper\IsGrantedFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Mezzio\Authentication\AuthenticationMiddleware;
use Mezzio\Authorization\AuthorizationMiddleware;
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
            'view_helpers' => [
                'invokables' => [
                    'flash'   => Flash::class,
                    'getRole' => GetRole::class,
                ],
                'factories'  => [
                    'isGranted' => IsGrantedFactory::class,
                ],
            ],
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
                // UserRepositoryInterface::class => Repository\AuthUserRepository::class,
                // AccessTokenRepositoryInterface::class => Repository\OauthAccessTokenRepository::class,
                // AuthCodeRepositoryInterface::class => Repository\OauthAuthCodesRepository::class,
                // ClientRepositoryInterface::class => Repository\OauthClientsRepository::class,
                // RefreshTokenRepositoryInterface::class => Repository\OauthRefreshTokensRepository::class,
                // ScopeRepositoryInterface::class => Repository\OauthScopesRepository::class,
                // UserRepositoryInterface::class => Repository\AuthUserRepository::class,
                // //AuthenticationInterface1::class => OAuth2Adapter2::class,
                // Authentication\AuthenticationInterface::class => Authentication\OAuth2\OAuth2Adapter::class,
            ],
            'invokables' => [
                LogoutHandler::class => LogoutHandler::class,
            ],
            'factories' => [
                //Handler\UserHandler::class => Handler\UserHandlerFactory::class,
                HomePageHandler::class => HomePageHandlerFactory::class,
                'doctrine.driver.orm_default'         => DriverFactory::class,
                'doctrine.entity_manager.orm_default' => EntityManagerFactory::class,
                AdminPageHandler::class => AdminPageHandlerFactory::class,
                LoginPageHandler::class => LoginPageHandlerFactory::class,
                PrgMiddleware::class    => InvokableFactory::class,
                UserMiddleware::class   => UserMiddlewareFactory::class,
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
                'user' => [__DIR__ . '/../templates/user'],
            ],
        ];
    }
    public function registerRoutes(Application $app, string $basePath = '/user'): void
    {
        $app->get('/', [
            AuthenticationMiddleware::class,
            AuthorizationMiddleware::class,
            HomePageHandler::class,
        ], 'home.view');

        $app->route('/admin', [
            AuthenticationMiddleware::class,
            AuthorizationMiddleware::class,
            AdminPageHandler::class,
        ], ['GET'], 'admin.view');

        $app->route('/login', [
            AuthorizationMiddleware::class,
            //csrf handling
            CsrfMiddleware::class,
            // prg handling
            PrgMiddleware::class,
            // the login page
            LoginPageHandler::class,
            // authentication handling
            AuthenticationMiddleware::class,
        ], ['GET', 'POST'], 'login.form');


        $app->get('/logout', [
            AuthenticationMiddleware::class,
            AuthorizationMiddleware::class,
            LogoutHandler::class,
        ], 'logout.access');
    }
}
