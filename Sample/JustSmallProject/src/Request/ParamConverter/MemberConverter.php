<?php

namespace Sample\JustSmallProject\Request\ParamConverter;

use Sample\JustSmallProject\Model\Member;
use Sample\JustSmallProject\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Jason Liu <lldong18@hotmail.com>
 */
final class MemberConverter
{
    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @param string $member
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return Member
     */
    public function convert($member, Request $request)
    {
        $username = $request->attributes->get('username');
        $member = $this->memberRepository->findByUsername($username);

        if (null === $member) {
            throw new NotFoundHttpException(sprintf('Member %s does not exist', $username));
        }

        return $member;
    }
}
