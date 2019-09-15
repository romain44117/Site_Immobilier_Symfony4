<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i =0; $i <= 100; $i++){
            $property = new Property();
            $property
                ->setName($faker->words(3,true))
                ->setDescription($faker->sentence(3, true))
                ->setBedrooms($faker->numberBetween(1,6))
                ->setFloor($faker->numberBetween(0,2))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)))
                ->setPostalCode($faker->postcode)
                ->setPrice($faker->numberBetween(150000,750000))
                ->setSold(false)
                ->setSurface($faker->numberBetween(40,400))
                ->setAdress($faker->address)
                ->setFilename('filename.png')
                ->setUpdatedAt(new \DateTime('now'))
                ->setCity($faker->city);

            $manager->persist($property);
        }
        $manager->flush();
    }
}
