<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Form\AppartmentType;
use App\Services\UploadFiles;
use App\Repository\AppartmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/appartment')]
class AppartmentController extends AbstractController
{
    #[Route('/', name: 'app_appartment_index', methods: ['GET'])]
    public function index(AppartmentRepository $appartmentRepository): Response
    {
        return $this->render('appartment/index.html.twig', [
            'allAppartment' => $appartmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_appartment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AppartmentRepository $appartmentRepository,UploadFiles $uploadFiles): Response
    {
        $appartment = new Appartment();
        $form = $this->createForm(AppartmentType::class, $appartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $appartment -> setAddBy($this->getUser());
            $appartment -> setCreatedAt(new \DateTimeImmutable());
            $appartment -> setSlug($appartment->getTitle());
            // $appartment -> setCategory($form->get('category')->getData());
            

            $image = $form->get('imageUrl')->getData();

            $appartment->setImageUrl($uploadFiles->moveFile($image));  


            $appartmentRepository->save($appartment, true);

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('appartment/new.html.twig', [
            'appartment' => $appartment,
            'appartmentForm' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appartment_show', methods: ['GET'])]
    public function show(Appartment $appartment): Response
    {
        return $this->render('appartment/show.html.twig', [
            'appartment' => $appartment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_appartment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Appartment $appartment, AppartmentRepository $appartmentRepository): Response
    {
        $form = $this->createForm(AppartmentType::class, $appartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appartmentRepository->save($appartment, true);

            return $this->redirectToRoute('app_appartment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('appartment/edit.html.twig', [
            'appartment' => $appartment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appartment_delete', methods: ['POST'])]
    public function delete(Request $request, Appartment $appartment, AppartmentRepository $appartmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appartment->getId(), $request->request->get('_token'))) {
            $appartmentRepository->remove($appartment, true);
        }

        return $this->redirectToRoute('app_appartment_index', [], Response::HTTP_SEE_OTHER);
    }
}
