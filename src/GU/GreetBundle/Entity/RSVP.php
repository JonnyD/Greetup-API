<?php

namespace GU\GreetBundle\Entity;

use GU\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * RSVP
 *
 * @ORM\Table("rsvp")
 * @ORM\Entity(repositoryClass="GU\GreetBundle\Repository\RSVPRepository")
 */
class RSVP
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
     * @var Greet
     *
     * @ORM\ManyToOne(targetEntity="GU\GreetBundle\Entity\Greet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $greet;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="GU\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var int
     */
    private $guests;

    /**
     * @var string
     */
    private $response;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Greet
     */
    public function getGreet()
    {
        return $this->greet;
    }

    /**
     * @param Greet $greet
     */
    public function setGreet($greet)
    {
        $this->greet = $greet;
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
     * @return int
     */
    public function getGuests()
    {
        return $this->guests;
    }

    /**
     * @param int $guests
     */
    public function setGuests($guests)
    {
        $this->guests = $guests;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
