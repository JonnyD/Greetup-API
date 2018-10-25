<?php

namespace GU\GreetBundle\Service;

use GU\GreetBundle\Entity\Greet;
use GU\GreetBundle\Entity\RSVP;
use GU\GreetBundle\Repository\RSVPRepository;
use GU\UserBundle\Entity\User;

class RSVPService
{
    /**
     * @var RSVPRepository
     */
    private $rsvpRepository;

    /**
     * @param RSVPRepository $rsvpRepository
     */
    public function __construct(RSVPRepository $rsvpRepository)
    {
        $this->rsvpRepository = $rsvpRepository;
    }

    /**
     * @param Greet $greet
     * @param User $user
     * @return RSVP
     */
    public function getRSVPByGreetAndUser(Greet $greet, User $user)
    {
        return $this->rsvpRepository->findOneBy([
            'greet' => $greet,
            'user' => $user
        ]);
    }

    /**
     * @param Greet $greet
     * @return RSVP[]
     */
    public function getRSVPsByGreet(Greet $greet)
    {
        return $this->rsvpRepository->findBy([
            'greet' => $greet
        ]);
    }

    /**
     * @param RSVP $rsvp
     * @param bool $sync
     */
    public function save(RSVP $rsvp, $sync = true)
    {
        $this->rsvpRepository->save($rsvp, $sync);
    }
}