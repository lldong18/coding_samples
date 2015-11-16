<?php

namespace Sample\JustSmallProject\DependencyInjection;

use Symfony\Component\HttpFoundation\Response;

/**
 * @property \Twig_Environment $twig
 *
 * @author Jason Liu <lldong18@hotmail.com>
 */
trait TwigTrait
{
    /**
     * @param string $view
     * @param array $parameters
     * @param Response $response
     *
     * @return Response
     */
    private function render($view, array $parameters = array(), Response $response = null)
    {
        $response = $response ?: new Response();

        $response->setContent($this->twig->render($view, $parameters));

        return $response;
    }
}
