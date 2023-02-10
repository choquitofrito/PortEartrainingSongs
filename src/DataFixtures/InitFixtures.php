<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Library;
use App\Entity\Song;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LibraryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();
        // generate data by calling methods

        $user1 = new User (['email'=> 'user01@gmail.com']);
        
        $l1 = new Library(['name'=>'library 1']);
        $l2 = new Library(['name'=>'library 2']);

        $user1->addLibrary($l1);
        $user1->addLibrary($l2);

        $s1 = new Song(['titre'=>'']);
        $s2 = new Song(['titre'=>'']);
        $s3 = new Song(['titre'=>'']);

        $l1->addSong($s1);
        $l1->addSong($s2);
        $l2->addSong($s3);
        


        // dd($l1);
        $manager->persist($l1);
        $manager->persist($l2);

        $manager->flush();
    }
}
