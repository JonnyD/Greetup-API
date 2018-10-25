<?php

namespace GU\FriendshipBundle\Entity;

use GU\UserBundle\Entity\User;

class Friendship
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var User
     */
    private $friend;

    /**
     * @var string
     */
    private $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return User
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * @param User $friend
     */
    public function setFriend(User $friend)
    {
        $this->friend = $friend;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }
}