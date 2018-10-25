<?php

namespace GU\GreetBundle\Service;

use GU\GreetBundle\Criteria\GreetCriteria;
use GU\GreetBundle\Entity\Greet;
use GU\GreetBundle\Repository\GreetRepository;

class GreetService
{
    /**
     * @var GreetRepository
     */
    private $greetRepository;

    /**
     * @param GreetRepository $greetRepository
     */
    public function __construct(GreetRepository $greetRepository)
    {
        $this->greetRepository = $greetRepository;
    }

    /**
     * @return Greet[]
     */
    public function getAllGreets()
    {
        return $this->greetRepository->findAll();
    }

    /**
     * @param int $id
     * @return Greet
     */
    public function getGreetById($id)
    {
        return $this->greetRepository->find($id);
    }

    /**
     * @param GreetCriteria $criteria
     * @return Greet[]
     */
    public function getGreetsByCriteria(GreetCriteria $criteria)
    {
        return $this->greetRepository->findByCriteria($criteria);
    }

    /**
     * @param Greet $greet
     * @param bool $sync
     */
    public function save(Greet $greet, bool $sync = true)
    {
        $this->greetRepository->save($greet, $sync);
    }

    /**
     * @param Greet $greet
     * @param bool $sync
     */
    public function remove(Greet $greet, $sync = true)
    {
        $this->greetRepository->remove($greet, $sync);
    }
}