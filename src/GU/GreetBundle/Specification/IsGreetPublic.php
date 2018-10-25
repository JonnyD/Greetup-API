<?php

namespace GU\GreetBundle\Specification;

use GU\GreetBundle\Entity\Greet;
use Tanigami\Specification\Specification;

class IsGreetPublic extends Specification
{
    /**
     * @param Greet $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $object->isPublic();
    }
}