<?php

namespace GU\GangBundle\Entity;

use GU\UserBundle\Entity\User;

class JoinRequest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Gang
     *
     * @ORM\ManyToOne(targetEntity="GU\GangBundle\Entity\Gang")
     * @ORM\JoinColumn(nullable=true)
     */
    private $gang;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="GU\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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