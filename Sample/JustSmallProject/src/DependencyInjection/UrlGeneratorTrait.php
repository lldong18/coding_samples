<?php

namespace Sample\JustSmallProject\DependencyInjection;

use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * @property UrlGenerator $urlGenerator
 *
 * @author Jason Liu <lldong18@hotmail.com>
 */
trait UrlGeneratorTrait
{
    /**
     * @param string $route
     * @param mixed $parameters
     *
     * @return string
     */
    private function path($route, $parameters = array())
    {
        return $this->urlGenerator->generate($route, $parameters);
    }
}
