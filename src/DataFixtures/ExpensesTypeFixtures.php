<?php

namespace App\DataFixtures;

use App\Entity\ExpensesType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpensesTypeFixtures extends Fixture
{
    public const ESSENCE = 'essence';
    public const PEAGE = 'peage';
    public const REPAS = 'repas';
    public const CONFERENCE = 'conference';

    public function load(ObjectManager $manager): void
    {

        $gasoline = new ExpensesType();
        $gasoline->setLabel('ESSENCE');
        $this->addReference(self::ESSENCE, $gasoline);
        $manager->persist($gasoline);

        $toll = new ExpensesType();
        $toll->setLabel('PEAGE');
        $this->addReference(self::PEAGE, $toll);
        $manager->persist($toll);

        $meal = new ExpensesType();
        $meal->setLabel('REPAS');
        $this->addReference(self::REPAS, $meal);
        $manager->persist($meal);

        $lecture = new ExpensesType();
        $lecture->setLabel('CONFERENCE');
        $this->addReference(self::CONFERENCE, $lecture);
        $manager->persist($lecture);

        $manager->flush();
    }
}
