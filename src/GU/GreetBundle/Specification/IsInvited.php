<?php

namespace GU\GreetBundle\Specification;

use GU\GreetBundle\Entity\Greet;
use GU\UserBundle\Entity\User;
use Tanigami\Specification\Specification;

class IsInvited extends Specification
{
    private $loggedInUser;

    public function __construct(User $user)
    {
        $this->loggedInUser = $user;
    }

    /**
     * @param Greet $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $object->isInvited($this->loggedInUser);
    }
}