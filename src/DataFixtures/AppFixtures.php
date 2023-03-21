<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Appartment;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        ##CATEGORY --------------

        $all_category = [];

        $category = new Category();
        $category->setTitle('Appartement');
        $all_category[] = $category;
        $manager -> persist($category);

        $category = new Category();
        $category->setTitle('Maison');
        $all_category[] = $category;
        $manager -> persist($category);

        $category = new Category();
        $category->setTitle('Hôtel');
        $all_category[] = $category;
        $manager -> persist($category);

        $category = new Category();
        $category->setTitle("Maison d'hôtes");
        $all_category[] = $category;
        $manager -> persist($category);

        ##USER ------------------

        $all_user = [];

        for ($i=0; $i < 5; $i++) { 
            $user = new User;

            $user -> setEmail($faker-> email());
            $user -> setPassword(password_hash('admin', PASSWORD_BCRYPT));

            $all_user[] = $user;

        
            $manager -> persist($user);
        }

        ##APPARTMENT ------------

        for ($i=0; $i < 10; $i++) { 
            $appartment = new Appartment;

            $randomKeyUser = array_rand($all_user,1);
            $randomKeyCategory = array_rand($all_category,1);


            $appartment -> setTitle($faker-> text());
            $appartment -> setDescription($faker->paragraph());
            $appartment -> setPrice((int) $faker->numberBetween(40, 600));
            $appartment -> setIntroduction($faker->text());
            $appartment -> setNbRoom((int) $faker->numberBetween(1, 10));
            $appartment -> setCreatedAt(new \DateTimeImmutable);
            $appartment -> setCategory($all_category[$randomKeyCategory]);
            $appartment -> setAddBy($all_user[$randomKeyUser]);
            
            $appartment -> setSlug($slugify->slugify($appartment->getTitle()));

            
            $manager -> persist($appartment);
        }

        

        $manager->flush();
    }
}
