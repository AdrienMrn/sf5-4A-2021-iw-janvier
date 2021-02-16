<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $tags = [];
        for ($i = 0; $i < 10; $i++) {
            $tags[] = $faker->colorName;
        }
        $tags = array_unique($tags);

        foreach ($tags as $tag) {
            $tag = (new Tag())->setName($tag);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
