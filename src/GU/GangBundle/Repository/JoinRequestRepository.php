<?php

namespace GU\GangBundle\Repository;

use Doctrine\ORM\EntityRepository;
use GU\GangBundle\Criteria\JoinRequestCriteria;
use GU\GangBundle\Entity\JoinRequest;

class JoinRequestRepository extends EntityRepository
{
    /**
     * @param JoinRequest $joinRequest
     * @param bool $sync
     */
    public function save(JoinRequest $joinRequest, $sync = true)
    {
        $this->getEntityManager()->persist($joinRequest);
        if ($sync) {
            $this->flush();
        }
    }

    /**
     * @param JoinRequest $joinRequest
     * @param bool $sync
     */
    public function remove(JoinRequest $joinRequest, $sync = true)
    {
        $this->getEntityManager()->remove($joinRequest);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param JoinRequestCriteria $criteria
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByCriteria(JoinRequestCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('g')
            ->from('GU\GreetBundle\Entity\JoinRequest', 'j');

        if ($criteria->getGang() != null) {
            $qb->andWhere('j.gang = :gang');
            $qb->setParameter('gang', $criteria->getGang());
        }

        if ($criteria->getUser() != null) {
            $qb->andWhere('j.user = :user');
            $qb->setParameter('user', $criteria->getUser());
        }

        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();

        return $result;
    }
}