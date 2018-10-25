<?php

namespace GU\GangBundle\Criteria;

use GU\GangBundle\Entity\Gang;
use GU\UserBundle\Entity\User;

class JoinRequestCriteria
{
    /**
     * @var Gang
     */
    private $gang;

    /**
     * @var User
     */
    private $user;

    /**
     * @return Gang
     */
    public function getGang()
    {
        return $this->gang;
    }

    /**
     * @param Gang $gang
     */
    public function setGang(Gang $gang)
    {
        $this->gang = $gang;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}