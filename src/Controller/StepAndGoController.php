<?php

namespace App\Controller;

use App\Repository\DanceClassesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StepAndGoController extends AbstractController
{
    #[Route('/step', name: 'app_step_and_go')]
    public function index(): Response
    {
        return $this->render('step_and_go/index.html.twig');
    }

    #[Route('/step/classes', name: 'app_dance_classes')]
    public function show(DanceClassesRepository $danceClassesRepository): Response
    {
        $danceClasses = $danceClassesRepository->findAll();
        return $this->render('step_and_go/showClasses.html.twig', [
            'danceClasses' => $danceClasses,
        ]);
    }
}
