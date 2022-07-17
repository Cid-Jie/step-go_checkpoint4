<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StepAndGoController extends AbstractController
{
    #[Route('/step', name: 'app_step_and_go')]
    public function index(): Response
    {
        return $this->render('step_and_go/index.html.twig', [
            'website' => 'Step&Go',
        ]);
    }
}
