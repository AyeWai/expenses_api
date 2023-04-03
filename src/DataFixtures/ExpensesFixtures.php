<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Expenses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExpensesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $expense = new Expenses();
        $expense->setDate(new DateTime('02-03-2023'));
        $expense->setAmount(23);
        $expense->setRegisteringdate(new DateTime(date('j-m-Y')));
        $expense->setCompanyname('Kiss The Bride');
        $expense->setUser($this->getReference(UserFixtures::USER1));
        $expense->setExpensestype($this->getReference(ExpensesTypeFixtures::REPAS));
        $manager->persist($expense);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ExpensesTypeFixtures::class,
        ];
    }
}
