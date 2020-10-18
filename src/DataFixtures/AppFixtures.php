<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\Income;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 45; $i++)
        {
            $expenses = new Expense();
            $expenses->setDate($faker->dateTimeBetween('-9 months', 'now'));
            $expenses->setAmount($faker->randomFloat(2, 0, 450));
            $expenses->setTitle('Test' . $i);
            $expenses->setStore($faker->company);

            $inc = new Income();
            $inc->setDate($faker->dateTimeBetween('-9 months', 'now'));
            $inc->setAmount($faker->randomFloat(2, 0, 450));
            $inc->setTitle('Test' . $i);

            $manager->persist($inc);

            $manager->persist($expenses);
        }

        $manager->flush();
    }
}
