<?php

namespace Sample\JustSmallProject;

use Doctrine\DBAL\Connection;
use Silex\Application\FormTrait;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class Application extends \Silex\Application
{
    const ENV_DEV = 'dev';
    const ENV_PROD = 'prod';

    /**
     * @return Connection
     */
    public function getDoctrine()
    {
        return $this['db'];
    }
}
