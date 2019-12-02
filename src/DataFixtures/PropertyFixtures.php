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

        for($i = 0; $i < 50 ; $i++) {
            $property = new Property();
            $property->setTitle($faker->words(3, true))
            ->setDescription($faker->sentences(3, true))
            ->setSurface($faker->numberBetween(20, 250))
            ->setRooms($faker->numberBetween(1,10))
            ->setBedRooms($faker->numberBetween(1,9))
            ->setFloor($faker->numberBetween(0,15))
            ->setPrice($faker->numberBetween(50000, 1000000))
            ->setHeat($faker->numberBetween(0,count(Property::HEAT) - 1))
            ->setCity($faker->city)
            ->setAddress($faker->address)
            ->setPostaleCode($faker->postCode)
            ->setSold(false);

            $manager->persist($property);
    
        
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
