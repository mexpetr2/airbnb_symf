<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // $all_category = [];

        // $category = new Category();
        // $category->setTitle('Appartement');
        // $all_category[] = $category;
        // $manager -> persist($category);

        // $category = new Category();
        // $category->setTitle('Maison');
        // $all_category[] = $category;
        // $manager -> persist($category);

        // $category = new Category();
        // $category->setTitle('Hôtel');
        // $all_category[] = $category;
        // $manager -> persist($category);

        // $category = new Category();
        // $category->setTitle("Maison d'hôtes");
        // $all_category[] = $category;
        // $manager -> persist($category);


        // $manager->flush();
    }
}
