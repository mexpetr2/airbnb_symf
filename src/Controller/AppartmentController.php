<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Form\AppartmentType;
use App\Services\UploadFiles;
use App\Repository\AppartmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppartmentController extends AbstractController
{
    #[Route('/appartment/new', name: 'app_appartment_form')]
    public function index(Request $request,EntityManagerInterface $entityManager,Security $security,UploadFiles $uploadFiles, AppartmentRepository $AppartmentRepo): Response
    {

        $appartment = new Appartment;
        $form = $this->createForm(AppartmentType::class, $appartment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appartment -> setAddBy($this->getUser());
            $appartment -> setCreatedAt(new \DateTimeImmutable());
            $appartment -> setSlug($appartment->getTitle());

            $image = $form->get('image')->getData();

            $appartment->setImageUrl($uploadFiles->moveFile($image));  

            $AppartmentRepo->save($appartment, true);


            $entityManager->persist($appartment);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('appartment/appartment_form.html.twig', [
            'controller_name' => 'AppartmentController',
            'appartmentForm' => $form->createView(),
        ]);
    }
}
