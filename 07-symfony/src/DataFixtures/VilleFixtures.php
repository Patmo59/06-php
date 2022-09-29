<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ville;
use App\Entity\Departement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create();
        // for ($j=0;$j<10; $j++)
        // {
        //     $dep = new Departement();
        //     $dep ->setNom($faker -> state())
        //         ->setCode($faker ->randomNumber(2,true));

        //         $manager ->persist($dep);
        //     for($i=0;$i<10;$i++){
        //         $ville = new Ville();
        //         $ville ->setNom($faker ->city())
        //                 -> setPopulation($faker -> randomNumber(6, true))
        //                 -> setCreatedAt(\DateTimeImmutable::createFromMutable($faker -> dateTimeThisDecade()))
        //                 -> setDepartement($dep);
        //         $manager ->persist($ville);
        //     }
        //     dd($dep);
        //     $dep ->setChefLieu($ville);
        //     $manager ->persist($dep);
        // }
        // $manager->flush();
        $faker = Factory::create();
        for ($j=0; $j < 10; $j++) 
        { 
            $dep = new Departement();
            $dep->setNom($faker->state())
                ->setCode($faker->randomNumber(2, true));
            $manager->persist($dep);
            for ($i=0; $i < 10; $i++) { 
                $ville = new Ville();
                $ville  ->setNom($faker->city())
                        ->setPopulation($faker->randomNumber(6, true))
                        ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeThisDecade()))
                        ->setDepartement($dep);
                $manager->persist($ville);
            }
            $dep->setChefLieu($ville);
            $manager->persist($dep);
        }
        $manager->flush();
    }

}
