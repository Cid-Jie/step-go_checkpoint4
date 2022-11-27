<?php

namespace App\Controller;

use App\Entity\EventPlanning;
use App\Form\EventPlanningType;
use App\Repository\EventPlanningRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event/planning')]
class EventPlanningController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_event_planning_index', methods: ['GET'])]
    public function index(EventPlanningRepository $eventPlanningRepository): Response
    {
        return $this->render('event_planning/index.html.twig', [
            'event_plannings' => $eventPlanningRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_event_planning_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EventPlanningRepository $eventPlanningRepository): Response
    {
        $eventPlanning = new EventPlanning();
        $form = $this->createForm(EventPlanningType::class, $eventPlanning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventPlanningRepository->add($eventPlanning, true);

            return $this->redirectToRoute('app_event_planning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_planning/new.html.twig', [
            'event_planning' => $eventPlanning,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_event_planning_show', methods: ['GET'])]
    public function show(EventPlanning $eventPlanning): Response
    {
        return $this->render('event_planning/show.html.twig', [
            'event_planning' => $eventPlanning,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_event_planning_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EventPlanning $eventPlanning, EventPlanningRepository $eventPlanningRepository): Response
    {
        $form = $this->createForm(EventPlanningType::class, $eventPlanning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventPlanningRepository->add($eventPlanning, true);

            return $this->redirectToRoute('app_event_planning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_planning/edit.html.twig', [
            'event_planning' => $eventPlanning,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_event_planning_delete', methods: ['POST'])]
    public function delete(Request $request, EventPlanning $eventPlanning, EventPlanningRepository $eventPlanningRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventPlanning->getId(), $request->request->get('_token'))) {
            $eventPlanningRepository->remove($eventPlanning, true);
        }

        return $this->redirectToRoute('app_event_planning_index', [], Response::HTTP_SEE_OTHER);
    }
}
