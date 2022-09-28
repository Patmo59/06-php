<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ville;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i=0;$i<10;$i++){
            $ville = new Ville();
            $ville ->setNom($faker ->city())
                    -> setPopulation($faker -> randomNumber(6, true))
                    -> setCreatedAt(\DateTimeImmutable::createFromMutable($faker -> dateTimeThisDecade()));
            $manager ->persist($ville);
        }

        $manager->flush();
    }
}
