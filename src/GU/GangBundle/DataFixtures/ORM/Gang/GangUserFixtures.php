<?php

namespace GU\GangBundle\DataFixtures\ORM\Gang;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GU\GangBundle\Entity\Gang;
use GU\GangBundle\Entity\GangUser;
use GU\GangBundle\Enum\Role;
use GU\GreetBundle\Entity\Greet;
use GU\UserBundle\DataFixtures\ORM\User\UserFixtures;
use GU\UserBundle\Entity\User;

class GangUserFixtures extends AbstractFixture implements DependentFixtureInterface
{
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $gang1 = $this->getReference('gang1');
        $gang2 = $this->getReference('gang2');
        $gang3 = $this->getReference('gang3');

        $user1 = $this->getReference('user1');
        $user2 = $this->getReference('user2');
        $user3 = $this->getReference('user3');

        $gangUser1 = $this->createGangUser($gang1, $user1, Role::FOUNDER);
        $gangUser2 = $this->createGangUser($gang1, $user2, Role::USER);
        $gangUser3 = $this->createGangUser($gang2, $user1, Role::FOUNDER);
        $gangUser4 = $this->createGangUser($gang2, $user3, Role::ADMIN);
        $gangUser5 = $this->createGangUser($gang3, $user2, Role::FOUNDER);

        $manager->persist($gangUser1);
        $manager->persist($gangUser2);
        $manager->persist($gangUser3);
        $manager->persist($gangUser4);
        $manager->persist($gangUser5);

        $manager->flush();
    }

    /**
     * @param $key
     * @return Gang
     */
    private function getGang($key)
    {
        return $this->getReference($key);
    }

    /**
     * @param $key
     * @return User
     */
    private function getUser($key)
    {
        return $this->getReference($key);
    }

    /**
     * @param $gang
     * @param $user
     * @return GangUser
     */
    private function createGangUser($gang, $user, $role)
    {
        $gangUser = new GangUser();
        $gangUser->setGang($gang);
        $gangUser->setUser($user);
        $gangUser->setRole($role);
        return $gangUser;
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            GangFixtures::class
        ];
    }
}
