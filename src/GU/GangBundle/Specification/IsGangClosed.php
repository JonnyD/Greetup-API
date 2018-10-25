<?php

namespace GU\GangBundle\Specification;

use GU\GangBundle\Entity\Gang;
use Tanigami\Specification\Specification;

class IsGangClosed extends Specification
{
    /**
     * @param Gang $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return $object->isClosed();
    }
}