<?php

namespace GU\GreetBundle\DataFixtures\ORM\Greet;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GU\GreetBundle\Entity\Greet;
use GU\GreetBundle\Enum\Privacy;
use GU\UserBundle\DataFixtures\ORM\User\UserFixtures;
use GU\UserBundle\Entity\User;

class GreetFixtures extends AbstractFixture implements DependentFixtureInterface
{
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $user1 = $this->getUser('user1');

        $greet1 = $this->createGreet('Test 1', 'This is a description 1', 56.55555, 57.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet2 = $this->createGreet('Test 2', 'This is a description 2', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet3 = $this->createGreet('Test 3', 'This is a description 3', 37.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet4 = $this->createGreet('Test 4', 'This is a description 4', 38.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet5 = $this->createGreet('Test 5', 'This is a description 5', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet6 = $this->createGreet('Test 6', 'This is a description 6', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet7 = $this->createGreet('Test 7', 'This is a description 7', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet8 = $this->createGreet('Test 8', 'This is a description 8', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet9 = $this->createGreet('Test 9', 'This is a description 9', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet10 = $this->createGreet('Test 10', 'This is a description 10', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet11 = $this->createGreet('Test 11', 'This is a description 11', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);
        $greet12 = $this->createGreet('Test 12', 'This is a description 12', 36.55555, 33.4444, $user1, Privacy::PRIVACY_PUBLIC);

        $manager->persist($greet1);
        $manager->persist($greet2);
        $manager->persist($greet3);
        $manager->persist($greet4);
        $manager->persist($greet5);
        $manager->persist($greet6);
        $manager->persist($greet7);
        $manager->persist($greet8);
        $manager->persist($greet9);
        $manager->persist($greet10);
        $manager->persist($greet11);
        $manager->persist($greet12);

        $manager->flush();
    }

    /**
     * @param $name
     * @param $description
     * @param $latitude
     * @param $longitude
     * @return Greet
     */
    private function createGreet($name, $description, $latitude, $longitude, User $host, $privacy)
    {
        $greet = new Greet();
        $greet->setTitle($name);
        $greet->setDescription($description);
        $greet->setLatitude($latitude);
        $greet->setLongitude($longitude);
        $greet->setHost($host);
        $greet->setPrivacy($privacy);
        return $greet;
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
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}