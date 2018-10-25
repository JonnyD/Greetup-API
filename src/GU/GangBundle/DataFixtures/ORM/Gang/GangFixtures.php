<?php

namespace GU\GangBundle\DataFixtures\ORM\Gang;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GU\GangBundle\Entity\Gang;
use GU\GangBundle\Enum\MembershipApproval;
use GU\GangBundle\Enum\PostingPermission;
use GU\GangBundle\Enum\Privacy;
use GU\GreetBundle\Entity\Greet;
use GU\UserBundle\DataFixtures\ORM\User\UserFixtures;
use GU\UserBundle\Entity\User;

class GangFixtures extends AbstractFixture
{
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $gang1 = $this->createGang('Gang 1', 'This is a description', 56.55555, 55.55555,
            Privacy::PRIVACY_PUBLIC, MembershipApproval::ANY, PostingPermission::ADMIN);
        $gang2 = $this->createGang('Gang 1', 'This is a description', 56.55555, 55.55555,
            Privacy::PRIVACY_CLOSED, MembershipApproval::ADMIN, PostingPermission::ALL);
        $gang3 = $this->createGang('Gang 1', 'This is a description', 56.55555, 55.55555,
            Privacy::PRIVACY_SECRET, MembershipApproval::ADMIN, PostingPermission::ADMIN);

        $manager->persist($gang1);
        $manager->persist($gang2);
        $manager->persist($gang3);

        $manager->flush();

        $this->addReference('gang1', $gang1);
        $this->addReference('gang2', $gang2);
        $this->addReference('gang3', $gang3);
    }

    /**
     * @param string $name
     * @param string $description
     * @param float $longitude
     * @param float $latitude
     * @return Gang
     */
    private function createGang(
        string $name,
        string $description,
        float $longitude,
        float $latitude,
        string $privacy,
        string $membershipApproval,
        string $postingPermission)
    {
        $gang = new Gang();
        $gang->setName($name);
        $gang->setDescription($description);
        $gang->setLongitude($longitude);
        $gang->setLatitude($latitude);
        $gang->setPrivacy($privacy);
        $gang->setMembershipApproval($membershipApproval);
        $gang->setPostingPermission($postingPermission);
        return $gang;
    }
}
