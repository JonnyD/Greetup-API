<?php

namespace GU\GreetBundle\Hydrator;

use FOS\UserBundle\Model\UserManager;
use GU\GreetBundle\Criteria\GreetCriteria;

class GreetCriteriaHydrator
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param GreetCriteria $greetCriteria
     * @param array $data
     */
    public function hydrate(GreetCriteria $greetCriteria, $data)
    {
        if ($data['user_id'] != null) {
            $user = $this->userManager->findUserBy(['id' => $data['user_id']]);
            $greetCriteria->setUser($user);
        }
    }
}