<?php

namespace GU\GreetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use GU\GangBundle\Entity\Gang;
use GU\GreetBundle\Enum\Privacy;
use GU\UserBundle\Entity\User;
use JMS\Serializer\Annotation as JMS;

/**
 * Group
 *
 * @ORM\Table("greet")
 * @ORM\Entity(repositoryClass="GU\GreetBundle\Repository\GreetRepository")
 */
class Greet
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
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string")
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string")
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="privacy", type="string")
     */
    private $privacy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="GU\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $host;

    /**
     * @ORM\ManyToOne(targetEntity="GU\GangBundle\Entity\Gang")
     * @ORM\JoinColumn(nullable=true)
     */
    private $gang;

    /**
     * @var ArrayCollection|RSVP[]
     *
     * @ORM\OneToMany(targetEntity="GU\GreetBundle\Entity\RSVP", mappedBy="greet")
     */
    private $rsvps;

    /**
     * @var GreetInvitation[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="GU\GreetBundle\Entity\GreetInvitation", mappedBy="greet")
     */
    private $greetInvitations;

    public function __construct()
    {
        $this->rsvps = new ArrayCollection();
        $this->greetInvitations = new ArrayCollection();
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
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
    public function setPrivacy(string $privacy)
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
    public function isFriendsOnly()
    {
        return ($this->privacy === Privacy::PRIVACY_FRIENDS_ONLY);
    }

    /**
     * @return bool
     */
    public function isPrivate()
    {
        return ($this->privacy === Privacy::PRIVACY_PRIVATE);
    }

    /**
     * @return User
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param User $host
     */
    public function setHost(User $host)
    {
        $this->host = $host;
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
     * @return ArrayCollection|RSVP[]
     */
    public function getRsvps()
    {
        return $this->rsvps;
    }

    /**
     * @param ArrayCollection|RSVP[] $rsvps
     */
    public function setRsvps($rsvps)
    {
        $this->rsvps = $rsvps;
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
    public function setInvitations($greetInvitations)
    {
        $this->greetInvitations = $greetInvitations;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isInvited(User $user)
    {
        foreach ($this->greetInvitations as $invitation) {
            if ($invitation->getUser() == $user) {
                return true;
            }
        }

        return false;
    }
}
