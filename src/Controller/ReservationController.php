<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\AppartmentRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id_appartment}', name: 'app_reservation')]
    public function index(Request $request, $id_appartment, AppartmentRepository $appartmentRepo, ReservationRepository $ReservationRepository): Response
    {

        $reservation = new Reservation;

        $reservationForm = $this->createForm(ReservationType::class,$reservation);
        $reservationForm->handleRequest($request);

        if ($reservationForm->isSubmitted() && $reservationForm->isValid()) {
            $formData = $reservationForm->getData();
            $date_start = $reservationForm->getData()->getDateStart();
            $date_end = $reservationForm->getData()->getDateEnd();

            if($date_start < new \DateTime('now')){
                $errors[] = 'Veuillez choisir une date valide !';
                return $this->render('reservation/index.html.twig', [
                    'controller_name' => 'ReservationController',
                    'reservationForm' => $reservationForm,
                    'errors' => $errors,
                ]);

            }
            else if($date_start < $date_end){
                $error[] = 'Veuillez choisir des dates valide !';
                return $this->render('reservation/index.html.twig', [
                    'controller_name' => 'ReservationController',
                    'reservationForm' => $reservationForm,
                    'errors' => $errors,
                ]);
            }

            $appartment = $appartmentRepo->findOneBy(['id' => $id_appartment]);
            $reservation->setReservedBy($this->getUser());
            $reservation->setAppartment($appartment);

            dd($reservation);

            $ReservationRepository->save($reservation, true);

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);

        }

        
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservationForm' => $reservationForm,
        ]);
    }
}
