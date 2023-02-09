<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Library;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LibraryFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {

        // $faker = Factory::create();
        // generate data by calling methods

        $l1 = new Library(['name'=>'library 1']);
        $l2 = new Library(['name'=>'library 2']);
        dd($l1);
        $manager->persist($l1);
        $manager->persist($l2);

        $manager->flush();
    }
}
