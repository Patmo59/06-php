<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher){}
    public function load(ObjectManager $manager): void
    {

        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ["user"];
        // symfony console doctrine:fixtures:load --group=user --append
    }
}
