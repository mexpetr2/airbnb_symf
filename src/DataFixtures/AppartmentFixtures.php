<?php

namespace App\DataFixtures;


use App\Entity\Appartment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // $faker = Factory::create('fr_FR');

        // $slugify = new Slugify();

        // for ($i=0; $i < 10; $i++) { 
        //     $appartment = new Appartment;

        //     $randomKeyUser = array_rand($all_user,1);
        //     $randomKeyCategory = array_rand($all_category,1);


        //     $appartment -> setTitle($faker-> text());
        //     $appartment -> setDescription($faker->text());
        //     $appartment -> setPrice($faker->text());
        //     $appartment -> setIntroduction($faker->text());
        //     $appartment -> setNbRoom($faker->text());
        //     $appartment -> setCreatedAt(new \DateTimeImmutable);
        //     $appartment -> setCategory($all_category[$randomKeyCategory]);
        //     $appartment -> setAddBy($all_user[$randomKeyUser]);
            
        //     $appartment -> setSlug($slugify->slugify($appartment->getTitre()));

            
        //     $manager -> persist($appartment);
        // }

        // $manager->flush();

       
    }
}
