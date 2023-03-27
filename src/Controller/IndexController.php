<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\AppartmentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function allAppartment(AppartmentRepository $appartments, CategoryRepository $categoryRepo): Response
    {
        $all_category = $categoryRepo->findAll();
        
        $all_appartment = $appartments->findAll();


        return $this->render('index/index.html.twig', [
            'controller_name' => 'AppartmentController',
            'allAppartment' => $all_appartment,
            'allCategory' => $all_category,
        ]);
    }


    #[Route('/filter/{filter}', name: 'app_index_filtered')]
    public function filteredAppartment($filter,AppartmentRepository $appartments, CategoryRepository $categoryRepo): Response
    {
        $all_category = $categoryRepo->findAll();

        $all_appartment = $appartments->findBy([
            'category' => $filter
        ]);

        // dd($all_appartment);


        return $this->render('index/index.html.twig', [
            'controller_name' => 'AppartmentController',
            'allAppartment' => $all_appartment,
            'allCategory' => $all_category,
        ]);
    }
}
