<?php

namespace GU\GreetBundle\Entity;

use GU\GreetBundle\Enum\GreetInvitationResponse;
use GU\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * GreetInvitation
 *
 * @ORM\Table("greet_invitation")
 * @ORM\Entity(repositoryClass="GU\GangBundle\Repository\GreetInvitationRepository")
 */
class GreetInvitation
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
     * @ORM\JoinColumn(nullable=true)
     */
    private $greet;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="GU\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="response", type="string")
     */
    private $response;

    public function __construct()
    {
        $this->response = GreetInvitationResponse::NO_RESPONSE;
    }

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
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
