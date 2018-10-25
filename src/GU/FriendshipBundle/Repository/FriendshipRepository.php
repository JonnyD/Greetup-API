<?php

namespace GU\FriendshipBundle\Repository;

use Doctrine\ORM\EntityRepository;
use GU\FriendshipBundle\Entity\Friendship;
use GU\UserBundle\Entity\User;

class FriendshipRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return Friendship[]
     */
    public function findFriendshipsByUser(User $user)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT f FROM FriendshipBundle:Friendship f
                WHERE f.user = :user
                OR f.friend = :user')
            ->setParameter('user', $user);

        return $query->getResult();
    }

    /**
     * @param Friendship $friendship
     * @param bool $sync
     */
    public function save(Friendship $friendship, $sync = true)
    {
        $this->getEntityManager()->persist($friendship);
        if ($sync) {
            $this->flush();
        }
    }

    /**
     * @param Friendship $friendship
     * @param bool $sync
     */
    public function remove(Friendship $friendship, $sync = true)
    {
        $this->getEntityManager()->remove($friendship);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}