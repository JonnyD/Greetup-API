<?php

namespace GU\GangBundle\Specification;

use GU\GangBundle\Entity\Gang;
use GU\UserBundle\Entity\User;
use Tanigami\Specification\Specification;

class IsMemberOfGang extends Specification
{
    /**
     * @var User
     */
    private $loggedInUser;

    public function __construct(User $user)
    {
        $this->loggedInUser = $user;
    }

    /**
     * @param Gang $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        $gangUsers = $object->getGangUsers();

        foreach ($gangUsers as $gangUser) {
            if ($gangUser->getUser() == $this->loggedInUser) {
                return true;
            }
        }

        return false;
    }
}