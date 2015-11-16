<?php

namespace Sample\JustSmallProject\Model;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class Height
{
    /**
     * @var string
     */
    private $height;

    /**
     * @param string $height
     */
    public function __construct($height)
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->height;
    }
}
