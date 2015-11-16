<?php

namespace Sample\JustSmallProject\Model;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class BodyType
{
    /**
     * @return array
     */
    public static function all()
    {
        return [
            'Slim',
            'Fit',
            'Muscular',
            'Average/medium',
            'Shapely toned',
            'A few extra pounds',
            'Full sized',
            'Zaftig (Voluptuous/Curvy)'
        ];
    }
}
