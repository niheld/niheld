<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence($nbWords = 5, $variableNbWords = true))
                 ->setContent($faker->sentence($nbWords = 20, $variableNbWords = true))
                 ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                 ->setUpdatedAt($faker->dateTimeBetween('-6 months'));
            $manager->persist($post);
        }

        $manager->flush();
    }
}
