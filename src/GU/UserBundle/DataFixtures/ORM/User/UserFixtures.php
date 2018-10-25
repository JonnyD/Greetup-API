<?php

namespace GU\UserBundle\DataFixtures\ORM\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use GU\UserBundle\Entity\User;

class UserFixtures extends AbstractFixture
{
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $user1 = $this->createUser('jonny1', 'pass', 'contact@jonnydevine.com');
        $user2 = $this->createUser('jonny2', 'pass', 'contact2@jonnydevine.com');
        $user3 = $this->createUser('jonny3', 'pass', 'contact3@jonnydevine.com');
        $user4 = $this->createUser('jonny4', 'pass', 'contact4@jonnydevine.com');
        $user5 = $this->createUser('jonny5', 'pass', 'contact5@jonnydevine.com');
        $user6 = $this->createUser('jonny6', 'pass', 'contact6@jonnydevine.com');
        $user7 = $this->createUser('jonny7', 'pass', 'contact7@jonnydevine.com');
        $user8 = $this->createUser('jonny8', 'pass', 'contact8@jonnydevine.com');
        $user9 = $this->createUser('jonny9', 'pass', 'contact9@jonnydevine.com');
        $user10 = $this->createUser('jonny10', 'pass', 'contact10@jonnydevine.com');
        $user11 = $this->createUser('jonny11', 'pass', 'contact11@jonnydevine.com');
        $user12 = $this->createUser('jonny12', 'pass', 'contact12@jonnydevine.com');
        $user13 = $this->createUser('jonny13', 'pass', 'contact13@jonnydevine.com');

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->persist($user6);
        $manager->persist($user7);
        $manager->persist($user8);
        $manager->persist($user9);
        $manager->persist($user10);
        $manager->persist($user11);
        $manager->persist($user12);
        $manager->persist($user13);

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
        $this->addReference('user4', $user4);
        $this->addReference('user5', $user5);

        $manager->flush();
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @return User
     */
    private function createUser($username, $password, $email)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPlainPassword($password);
        $user->setEmail($email);
        $user->setEnabled(true);
        return $user;
    }
}