<?php

namespace Sample\JustSmallProject\Model;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class Weight
{
    /**
     * @var string
     */
    private $weight;

    /**
     * @param string $weight
     */
    public function __construct($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->weight;
    }
}
