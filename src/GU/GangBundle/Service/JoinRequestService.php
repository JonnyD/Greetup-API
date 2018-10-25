<?php

namespace GU\GangBundle\Service;

use GU\GangBundle\Criteria\JoinRequestCriteria;
use GU\GangBundle\Entity\Gang;
use GU\GangBundle\Entity\JoinRequest;
use GU\GangBundle\Repository\GangRepository;
use GU\GangBundle\Repository\JoinRequestRepository;
use GU\UserBundle\Entity\User;

class JoinRequestService
{
    /**
     * @var JoinRequestRepository
     */
    private $joinRequestRepository;

    /**
     * @param JoinRequestRepository $joinRequestRepository
     */
    public function __construct(JoinRequestRepository $joinRequestRepository)
    {
        $this->joinRequestRepository = $joinRequestRepository;
    }

    /**
     * @param int $id
     * @return null|JoinRequest
     */
    public function getJoinRequestById(int $id)
    {
        return $this->joinRequestRepository->find($id);
    }

    /**
     * @param Gang $gang
     * @param User $user
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getJoinRequestByGangAndUser(Gang $gang, User $user)
    {
        $criteria = new JoinRequestCriteria();
        $criteria->setGang($gang);
        $criteria->setUser($user);

        return $this->joinRequestRepository->findOneByCriteria($criteria);
    }

    /**
     * @param JoinRequest $joinRequest
     * @param bool $sync
     */
    public function save(JoinRequest $joinRequest, $sync = true)
    {
        $this->joinRequestRepository->save($joinRequest, $sync);
    }
    /**
     * @param JoinRequest $joinRequest
     * @param bool $sync
     */
    public function remove(JoinRequest $joinRequest, $sync = true)
    {
        $this->joinRequestRepository->remove($joinRequest);
    }
}