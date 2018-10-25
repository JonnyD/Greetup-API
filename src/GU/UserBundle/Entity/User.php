<?php

namespace GU\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use GU\GangBundle\Entity\GangUser;
use GU\GreetBundle\Entity\GreetInvitation;
use GU\GreetBundle\Entity\Invitation;
use JMS\Serializer\Annotation as Serializer;

/**
 * User
 *
 * @Serializer\ExclusionPolicy("all")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table("users")
 * @ORM\Entity(repositoryClass="GU\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @Serializer\Expose
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection|GangUser[]
     *
     * @ORM\OneToMany(targetEntity="GU\GangBundle\Entity\GangUser", mappedBy="user")
     */
    private $gangUsers;

    /**
     * @var ArrayCollection|GreetInvitation[]
     *
     * @ORM\OneToMany(targetEntity="GU\GreetBundle\Entity\GreetInvitation", mappedBy="user")
     */
    private $greetInvitations;

    public function __construct()
    {
        parent::__construct();

        $this->gangUsers = new ArrayCollection();
        $this->greetInvitations = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection|GangUser[]
     */
    public function getGangUsers()
    {
        return $this->gangUsers;
    }

    /**
     * @param ArrayCollection|GangUser[] $gangUsers
     */
    public function setGangUsers($gangUsers)
    {
        $this->gangUsers = $gangUsers;
    }

    /**
     * @return ArrayCollection|GreetInvitation[]
     */
    public function getGreetInvitations()
    {
        return $this->greetInvitations;
    }

    /**
     * @param ArrayCollection|GreetInvitation[] $greetInvitations
     */
    public function setGreetInvitations($greetInvitations)
    {
        $this->greetInvitations = $greetInvitations;
    }
}
