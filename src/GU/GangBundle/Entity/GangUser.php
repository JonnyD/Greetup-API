<?php

namespace GU\GangBundle\Entity;

use GU\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * GangUser
 *
 * @ORM\Table("gang_user")
 * @ORM\Entity(repositoryClass="GU\GangBundle\Repository\GangUserRepository")
 */
class GangUser
{
    /**
     * @var int
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $gang;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="GU\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string")
     */
    private $role;

    /**
     * @return int
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
    public function setGang($gang)
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
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }
}
