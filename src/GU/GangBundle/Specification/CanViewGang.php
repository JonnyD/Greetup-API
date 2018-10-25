<?php

namespace GU\GangBundle\Specification;

use GU\GangBundle\Entity\Gang;
use GU\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Tanigami\Specification\Specification;

class CanViewGang extends Specification
{
    /**
     * @var User
     */
    private $loggedInUser;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->loggedInUser = $tokenStorage->getToken()->getUser();
    }

    /**
     * @param Gang $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        $isGangPublic = new IsGangPublic();
        $isGangClosed = new IsGangClosed();
        $isMemberOfGang = new IsMemberOfGang($this->loggedInUser);

        return $isGangPublic
            ->or($isGangClosed)
            ->or($isMemberOfGang)
            ->isSatisfiedBy($object);
    }
}