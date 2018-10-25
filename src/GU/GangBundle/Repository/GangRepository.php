<?php

namespace GU\GangBundle\Repository;

use Doctrine\ORM\EntityRepository;
use GU\GangBundle\Entity\Gang;
use DoctrineExtensions\Query\Mysql\Acos;
use DoctrineExtensions\Query\Mysql\Cos;
use DoctrineExtensions\Query\Mysql\Radians;

class GangRepository extends EntityRepository
{
    public function findGangsWithinRadius(float $latitude, float $longitude, int $radius)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT
                    g.id,
                    (
                        6371 *
                            acos(
                                cos( radians( :latitude ) ) *
                                cos( radians( g.latitude ) ) *
                                cos(
                                    radians( g.longitude ) - radians( :longitude )
                                ) +
                                sin(radians(:latitude)) *
                                sin(radians(g.latitude))
                        )
                    ) distance
                FROM
                    GangBundle:Gang g
                HAVING
                    distance < :radius
                ORDER BY
                    distance')
            ->setParameter('latitude', $latitude)
            ->setParameter('longitude', $longitude)
            ->setParameter('radius', $radius);
        return $query->getResult();
    }
    /**
     * @param Gang $group
     * @param bool $sync
     */
    public function save(Gang $group, $sync = true)
    {
        $this->getEntityManager()->persist($group);
        if ($sync) {
            $this->flush();
        }
    }

    /**
     * @param Gang $group
     * @param bool $sync
     */
    public function remove(Gang $group, $sync = true)
    {
        $this->getEntityManager()->remove($group);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}