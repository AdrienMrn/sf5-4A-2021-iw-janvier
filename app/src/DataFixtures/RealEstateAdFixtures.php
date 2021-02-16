<?php

namespace App\DataFixtures;

use App\Entity\RealEstateAd;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RealEstateAdFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $tags = $manager->getRepository(Tag::class)->findAll();

        for ($i = 0; $i < 20; $i++) {
            $realEstateAd = (new RealEstateAd())
                ->setTitle($faker->streetName)
                ->setDescription($faker->paragraph)
                ->setPrice($faker->numberBetween(80000, 2000000))
            ;

            shuffle($tags);
            for ($y = 0; $y < $faker->numberBetween(1, 5); $y++) {
                $realEstateAd->addTag($tags[$y]);
            }

            $manager->persist($realEstateAd);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          TagFixtures::class
        ];
    }
}
