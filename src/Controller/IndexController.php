<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function allAppartment(AppartmentRepository $appartments): Response
    {

        $all_appartment = $appartments->findAll();


        return $this->render('index/index.html.twig', [
            'controller_name' => 'AppartmentController',
            'allAppartment' => $all_appartment,
        ]);
    }
}
