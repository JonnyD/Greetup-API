<?php

namespace GU\GreetBundle\Specification;

use GU\FriendshipBundle\Service\FriendshipService;
use GU\GreetBundle\Entity\Greet;
use GU\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Tanigami\Specification\Specification;

class CanViewGreet extends Specification
{
    /**
     * @var User
     */
    private $loggedInUser;

    /**
     * @var FriendshipService
     */
    private $friendshipService;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        FriendshipService $friendshipService)
    {
        $this->loggedInUser = $tokenStorage->getToken()->getUser();
        $this->friendshipService = $friendshipService;
    }

    /**
     * @param Greet $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        $isPublic = new IsGreetPublic();
        $isFriend = new IsFriend($this->loggedInUser, $this->friendshipService);
        $isInvited = new IsInvited($this->loggedInUser);

        return $isPublic
            ->or($isFriend)
            ->or($isInvited)
            ->isSatisfiedBy($object);
    }
}