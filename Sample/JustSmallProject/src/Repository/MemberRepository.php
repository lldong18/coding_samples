<?php

namespace Sample\JustSmallProject\Repository;

use Sample\JustSmallProject\Model\Member;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
interface MemberRepository extends Repository
{
    /**
     * @param string $username
     *
     * @return Member|null
     */
    public function findByUsername($username);
}
