<?php

namespace GU\GreetBundle\Repository;

use Doctrine\ORM\EntityRepository;
use GU\GreetBundle\Criteria\GreetCriteria;
use GU\GreetBundle\Entity\Greet;

class GreetRepository extends EntityRepository
{
    /**
     * @param Greet $greet
     * @param bool $sync
     */
    public function save(Greet $greet, bool $sync = true)
    {
        $this->getEntityManager()->persist($greet);
        if ($sync) {
            $this->flush();
        }
    }

    /**
     * @param Greet $greet
     * @param bool $sync
     */
    public function remove(Greet $greet, $sync = true)
    {
        $this->getEntityManager()->remove($greet);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param GreetCriteria $criteria
     * @return Greet[]
     */
    public function findByCriteria(GreetCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('g')
            ->from('GU\GreetBundle\Entity\Greet', 'g');

        if ($criteria->getUser() != null) {
            $qb->andWhere('g.host = :host');
            $qb->setParameter('host', $criteria->getUser());
        }

        $query = $qb->getQuery();
        $results = $query->getResult();

        return $results;
    }
}