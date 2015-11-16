<?php

namespace Sample\JustSmallProject\Model;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class Ethnicity
{
    /**
     * @return array
     */
    public static function all()
    {
        return [
            'Caucasian (white)',
            'African American (black)',
            'Asian',
            'Hispanic',
            'First Nations',
            'East Indian',
            'Middle Eastern',
            'Other',
            'Rather Not Say',
        ];
    }
}
