<?php

namespace GU\GangBundle\Service;

use GU\GangBundle\Entity\Gang;
use GU\GangBundle\Repository\GangRepository;

class GangService
{
    /**
     * @var GangRepository
     */
    private $gangRepository;

    /**
     * @param GangRepository $gangRepository
     */
    public function __construct(GangRepository $gangRepository)
    {
        $this->gangRepository = $gangRepository;
    }

    public function getGangsWithinRadius(float $latitude, float $longitude, int $radius)
    {
        return $this->gangRepository->findGangsWithinRadius($latitude, $longitude, $radius);
    }

    /**
     * @return Gang[]
     */
    public function getAllGangs()
    {
        return $this->gangRepository->findAll();
    }

    /**
     * @param int $id
     * @return Gang
     */
    public function getGangById(int $id)
    {
        return $this->gangRepository->find($id);
    }

    /**
     * @param Gang $gang
     * @param bool $sync
     */
    public function save(Gang $gang, $sync = true)
    {
        $this->gangRepository->save($gang, $sync);
    }

    /**
     * @param Gang $gang
     * @param bool $sync
     */
    public function remove(Gang $gang, $sync = true)
    {
        $this->gangRepository->remove($gang);
    }
}