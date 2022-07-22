<?php

namespace App\Controller;

use App\Entity\DanceClasses;
use App\Form\DanceClassesType;
use App\Repository\DanceClassesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dance/classes')]
class DanceClassesController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_dance_classes_index', methods: ['GET'])]
    public function index(DanceClassesRepository $danceClassesRepository): Response
    {
        return $this->render('dance_classes/index.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_dance_classes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DanceClassesRepository $danceClassesRepository): Response
    {
        $danceClass = new DanceClasses();
        $form = $this->createForm(DanceClassesType::class, $danceClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $danceClassesRepository->add($danceClass, true);

            return $this->redirectToRoute('app_dance_classes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dance_classes/new.html.twig', [
            'dance_class' => $danceClass,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_dance_classes_show', methods: ['GET'])]
    public function show(DanceClasses $danceClass): Response
    {
        return $this->render('dance_classes/show.html.twig', [
            'dance_class' => $danceClass,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_dance_classes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DanceClasses $danceClass, DanceClassesRepository $danceClassesRepository): Response
    {
        $form = $this->createForm(DanceClassesType::class, $danceClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $danceClassesRepository->add($danceClass, true);

            return $this->redirectToRoute('app_dance_classes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dance_classes/edit.html.twig', [
            'dance_class' => $danceClass,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_dance_classes_delete', methods: ['POST'])]
    public function delete(Request $request, DanceClasses $danceClass, DanceClassesRepository $danceClassesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$danceClass->getId(), $request->request->get('_token'))) {
            $danceClassesRepository->remove($danceClass, true);
        }

        return $this->redirectToRoute('app_dance_classes_index', [], Response::HTTP_SEE_OTHER);
    }
}
