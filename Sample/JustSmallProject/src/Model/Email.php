<?php

namespace Sample\JustSmallProject\Model;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class Email
{
    /**
     * @var string
     */
    private $email;

    /**
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->email;
    }
}
