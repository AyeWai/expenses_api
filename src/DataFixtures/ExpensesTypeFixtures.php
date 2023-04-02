<?php

namespace App\DataFixtures;

use App\Entity\ExpensesType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpensesTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $gasoline = new ExpensesType();
        $gasoline->setLabel('ESSENCE');
        $manager->persist($gasoline);

        $toll = new ExpensesType();
        $toll->setLabel('PEAGE');
        $manager->persist($toll);

        $meal = new ExpensesType();
        $meal->setLabel('REPAS');
        $manager->persist($meal);

        $lecture = new ExpensesType();
        $lecture->setLabel('CONFERENCE');
        $manager->persist($lecture);

        $manager->flush();
    }
}
