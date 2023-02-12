<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Song;
use App\Entity\User;
use App\Entity\Library;
use App\Entity\StudyStatus;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InitFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();
        // generate data by calling methods

        $user1 = new User(['email' => 'user01@gmail.com']);
        $user1->setPassword($this->passwordHasher->hashPassword(
            $user1,
            'password'
        ));
        $user1->setRoles(['ROLE_USER']);

        $l1 = new Library([
            'name' => 'library 1',
            'description' => 'comment on library 1'
        ]);
        $l2 = new Library([
            'name' => 'library 2',
            'description' => 'comment on library 2'
        ]);

        $user1->addLibrary($l1);
        $user1->addLibrary($l2);

        $s1 = new Song([
            'title' => 'song1',
            'originalTempo' => 100,
            'originalTonality' => 'G',
            'fileLink' => 'song1.mp3'
        ]);
        $s2 = new Song([
            'title' => 'song2',
            'originalTempo' => 150,
            'originalTonality' => 'A',
            'fileLink' => 'song2.mp3'
        ]);
        $s3 = new Song([
            'title' => 'song3',
            'originalTempo' => 120,
            'originalTonality' => 'Bb',
            'fileLink' => 'song3.mp3'


        ]);

        $l1->addSong($s1);
        $l1->addSong($s2);
        $l2->addSong($s3);

        $ss1 = new StudyStatus(['tempoTonality'=> ['C'=>150, 'Db' => 200]]);
        $user1->addStudyStatus($ss1);
        $s1->addStudyStatus($ss1);

        $ss2 = new StudyStatus(['tempoTonality'=> ['C'=>110, 'Db' => 210]]);
        $user1->addStudyStatus($ss2);
        $s2->addStudyStatus($ss2);


        // dd($l1);
        $manager->persist($user1);

        $manager->flush();
    }
}
