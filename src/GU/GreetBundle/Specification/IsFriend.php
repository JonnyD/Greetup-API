<?php

namespace GU\GreetBundle\Specification;

use GU\FriendshipBundle\Service\FriendshipService;
use GU\GreetBundle\Entity\Greet;
use GU\UserBundle\Entity\User;
use Tanigami\Specification\Specification;

class IsFriend extends Specification
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
     * @param User $user
     * @param FriendshipService $friendshipService
     */
    public function __construct(User $user, FriendshipService $friendshipService)
    {
        $this->loggedInUser = $user;
        $this->friendshipService = $friendshipService;
    }

    /**
     * @param Greet $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $object->isFriendsOnly()
            && $this->friendshipService($this->loggedInUser, $object->getHost());
    }
}