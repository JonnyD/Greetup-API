<?php

namespace GU\GreetBundle\Repository;

use Doctrine\ORM\EntityRepository;
use GU\GreetBundle\Entity\RSVP;

class RSVPRepository extends EntityRepository
{
    /**
     * @param RSVP $rsvp
     * @param bool $sync
     */
    public function save(RSVP $rsvp, $sync = true)
    {
        $this->getEntityManager()->persist($rsvp);
        if ($sync) {
            $this->flush();
        }
    }

    /**
     * @param RSVP $rsvp
     * @param bool $sync
     */
    public function remove(RSVP $rsvp, $sync = true)
    {
        $this->getEntityManager()->remove($rsvp);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}