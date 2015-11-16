<?php

namespace Sample\JustSmallProject\DependencyInjection;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @property Session $session
 *
 * @author Jason Liu <lldong18@hotmail.com>
 */
trait SessionTrait
{
    /**
     * @param string $message
     */
    private function flashSuccess($message)
    {
        $this->flash('success', $message);
    }

    /**
     * @param string $message
     */
    private function flashAlert($message)
    {
        $this->flash('alert', $message);
    }

    /**
     * @param string $type
     * @param string $message
     */
    private function flash($type, $message)
    {
        $this->session->getFlashBag()->add($type, $message);
    }
}
