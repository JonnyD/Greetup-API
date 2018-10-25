<?php

namespace GU\GangBundle\Service;

use GU\GangBundle\Entity\Gang;
use GU\GangBundle\Entity\GangUser;
use GU\GangBundle\Repository\GangUserRepository;
use GU\UserBundle\Entity\User;

class GangUserService
{
    /**
     * @var GangUserRepository
     */
    private $gangUserRepository;

    /**
     * @param GangUserRepository $gangUserRepository
     */
    public function __construct(GangUserRepository $gangUserRepository)
    {
        $this->gangUserRepository = $gangUserRepository;
    }

    /**
     * @param int $id
     * @return null|GangUser
     */
    public function getGangUserById(int $id)
    {
        return $this->gangUserRepository->find($id);
    }

    /**
     * @param Gang $gang
     * @param User $user
     * @return GangUser
     */
    public function getGangUserByGangAndUser(Gang $gang, User $user)
    {
        return $this->gangUserRepository->findOneBy([
            'gang' => $gang,
            'user' => $user
        ]);
    }

    /**
     * @param Gang $gang
     * @return GangUser[]
     */
    public function getGangUsersByGang(Gang $gang)
    {
        return $this->gangUserRepository->findBy([
            'gang' => $gang
        ]);
    }

    /**
     * @param GangUser $gangUser
     * @param bool $sync
     */
    public function save(GangUser $gangUser, $sync = true)
    {
        $this->gangUserRepository->save($gangUser, $sync);
    }

    /**
     * @param GangUser $gangUser
     * @param bool $sync
     */
    public function remove(GangUser $gangUser, $sync = true)
    {
        $this->gangUserRepository->remove($gangUser, $sync);
    }
}