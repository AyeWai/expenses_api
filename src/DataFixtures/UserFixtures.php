<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER1 = 'user1';

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setFirstname('Thomas');
        $user->setLastname('Roger');
        $user->setMail('thomas.roger@ktb.fr');
        $user->setBirthday(new DateTime('01-02-1983'));
        $this->addReference(self::USER1, $user);
        $manager->persist($user);

        $manager->flush();
    }
}
