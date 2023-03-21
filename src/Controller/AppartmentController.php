<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Form\AppartmentType;
use App\Repository\AppartmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppartmentController extends AbstractController
{
    #[Route('/appartment', name: 'app_appartment')]
    public function index(Request $request,EntityManagerInterface $entityManager,Security $security): Response
    {

        $appartment = new Appartment;
        $form = $this->createForm(AppartmentType::class, $appartment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appartment);
            $entityManager->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('appartment/index.html.twig', [
            'controller_name' => 'AppartmentController',
            'form' => $form->createView(),
        ]);
    }


    #[Route('/appartment/all', name: 'app_appartment')]
    public function allAppartment(AppartmentRepository $appartments): Response
    {

        $all_appartment = $appartments->findAll();


        return $this->render('appartment/all.html.twig', [
            'controller_name' => 'AppartmentController',
            'allAppartment' => $all_appartment,
        ]);
    }
}
