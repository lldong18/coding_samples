<?php

namespace Sample\JustSmallProject\Provider;

use Sample\JustSmallProject\Repository\DoctrineMemberRepository;
use Sample\JustSmallProject\Request\ParamConverter\MemberConverter;
use Sample\JustSmallProject\Service;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class RepositoryServiceProvider implements ServiceProviderInterface
{
    const REPOSITORY_MEMBER = 'repository.member';
    const CONVERTER_MEMBER = 'converter.member';

    /**
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app[self::REPOSITORY_MEMBER] = function () use ($app) {
            return new DoctrineMemberRepository($app[Service::DATABASE]);
        };

        $app[self::CONVERTER_MEMBER] = $app->share(
            function () use ($app) {
                return new MemberConverter($app[self::REPOSITORY_MEMBER]);
            }
        );
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }
}
