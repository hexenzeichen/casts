<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Entity\StarshipDroid;
use App\Entity\StarshipPart;
use App\Factory\DroidFactory;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $starship = new Starship();
        $starship->setName('USS Taco Tuesday');
        $starship->setClass('Tex-Mex');
        $starship->checkIn();
        $starship->setCaptain('James T. Nacho');
        $manager->persist($starship);

        $part = new StarshipPart();
        $part->setName('spoiler');
        $part->setNotes('There\'s no air drag in space, but it looks cool.');
        $part->setPrice(500);
        $part->setStarship($starship);
        $manager->persist($part);
        $manager->flush();

        DroidFactory::createMany(100);
        StarshipFactory::createMany(20, fn() => [
//            'droids' => DroidFactory::randomRange(1, 5),
        ]);
        StarshipPartFactory::createMany(50);

        $ship = StarshipFactory::random();
        $droid = DroidFactory::random();

        $starshipDroid = new StarshipDroid();
        $starshipDroid->setStaship($ship);
        $starshipDroid->setDroid($droid);
        $manager->persist($starshipDroid);
        $manager->flush();

    }
}
