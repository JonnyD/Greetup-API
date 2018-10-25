<?php

namespace GU\GangBundle\Repository;

use Doctrine\ORM\EntityRepository;
use GU\GangBundle\Entity\GangUser;

class GangUserRepository extends EntityRepository
{
    /**
     * @param GangUser $gangUser
     * @param bool $sync
     */
    public function save(GangUser $gangUser, $sync = true)
    {
        $this->getEntityManager()->persist($gangUser);
        if ($sync) {
            $this->flush();
        }
    }

    /**
     * @param GangUser $gangUser
     * @param bool $sync
     */
    public function remove(GangUser $gangUser, $sync = true)
    {
        $this->getEntityManager()->remove($gangUser);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}