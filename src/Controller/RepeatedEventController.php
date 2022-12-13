<?php

namespace App\Controller;

use App\Entity\RepeatedEvent;
use App\Form\RepeatedEventType;
use App\Repository\RepeatedEventRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/repeated/event')]
class RepeatedEventController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_repeated_event_index', methods: ['GET'])]
    public function index(RepeatedEventRepository $repeatedEventRepository): Response
    {
        return $this->render('repeated_event/index.html.twig', [
            'repeated_events' => $repeatedEventRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_repeated_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RepeatedEventRepository $repeatedEventRepository): Response
    {
        $repeatedEvent = new RepeatedEvent();
        $form = $this->createForm(RepeatedEventType::class, $repeatedEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repeatedEventRepository->add($repeatedEvent, true);

            return $this->redirectToRoute('app_repeated_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('repeated_event/new.html.twig', [
            'repeated_event' => $repeatedEvent,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_repeated_event_show', methods: ['GET'])]
    public function show(RepeatedEvent $repeatedEvent): Response
    {
        return $this->render('repeated_event/show.html.twig', [
            'repeated_event' => $repeatedEvent,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_repeated_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RepeatedEvent $repeatedEvent, RepeatedEventRepository $repeatedEventRepository): Response
    {
        $form = $this->createForm(RepeatedEventType::class, $repeatedEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repeatedEventRepository->add($repeatedEvent, true);

            return $this->redirectToRoute('app_repeated_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('repeated_event/edit.html.twig', [
            'repeated_event' => $repeatedEvent,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_repeated_event_delete', methods: ['POST'])]
    public function delete(Request $request, RepeatedEvent $repeatedEvent, RepeatedEventRepository $repeatedEventRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repeatedEvent->getId(), $request->request->get('_token'))) {
            $repeatedEventRepository->remove($repeatedEvent, true);
        }

        return $this->redirectToRoute('app_repeated_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
