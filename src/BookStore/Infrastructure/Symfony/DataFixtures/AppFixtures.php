<?php

namespace App\BookStore\Infrastructure\Symfony\DataFixtures;

use App\BookStore\Infrastructure\Symfony\DataFixtures\Story\DefaultBookStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultBookStory::load();
    }
}
