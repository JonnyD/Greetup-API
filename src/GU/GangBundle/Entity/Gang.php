<?php

namespace GU\GangBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use GU\GangBundle\Enum\Privacy;
use GU\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Gang
 *
 * @ORM\Table("gang")
 * @ORM\Entity(repositoryClass="GU\GangBundle\Repository\GangRepository")
 */
class Gang
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
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var number
     *
     * @ORM\Column(name="longitude", precision=18, scale=12)
     */
    private $longitude;

    /**
     * @var number
     *
     * @ORM\Column(name="latitude", precision=18, scale=12)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="privacy", type="string")
     */
    private $privacy;

    /**
     * @var string
     *
     * @ORM\Column(name="membershipApproval", type="string")
     */
    private $membershipApproval;

    /**
     * @var string
     *
     * @ORM\Column(name="postingPermission", type="string")
     */
    private $postingPermission;

    /**
     * @var ArrayCollection|User[]
     *
     * @ORM\OneToMany(targetEntity="GU\GangBundle\Entity\GangUser", mappedBy="gang")
     */
    private $gangUsers;

    public function __construct()
    {
        $this->gangUsers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return number
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param number $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return number
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param number $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * @param string $privacy
     */
    public function setPrivacy($privacy)
    {
        $this->privacy = $privacy;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return ($this->privacy === Privacy::PRIVACY_PUBLIC);
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return ($this->privacy === Privacy::PRIVACY_CLOSED);
    }

    /**
     * @return bool
     */
    public function isSecret()
    {
        return ($this->privacy === Privacy::PRIVACY_SECRET);
    }

    /**
     * @return string
     */
    public function getMembershipApproval()
    {
        return $this->membershipApproval;
    }

    /**
     * @param string $membershipApproval
     */
    public function setMembershipApproval($membershipApproval)
    {
        $this->membershipApproval = $membershipApproval;
    }

    /**
     * @return string
     */
    public function getPostingPermission()
    {
        return $this->postingPermission;
    }

    /**
     * @param string $postingPermission
     */
    public function setPostingPermission($postingPermission)
    {
        $this->postingPermission = $postingPermission;
    }


    /**
     * @return GangUser[]|ArrayCollection
     */
    public function getGangUsers()
    {
        return $this->gangUsers;
    }

    /**
     * @param GangUser[] $gangUsers
     */
    public function setGangUsers($gangUsers)
    {
        $this->gangUsers = $gangUsers;
    }
}