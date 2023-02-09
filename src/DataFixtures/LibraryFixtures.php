<?php

namespace App\DataFixtures;

use App\Entity\Library;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LibraryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $library = new Library();
        $manager->persist($library);

        $manager->flush();
    }
}
