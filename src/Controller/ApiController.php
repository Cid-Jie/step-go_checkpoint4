<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
        $eventArray = [];
        foreach ($events as $event) {
            $eventArray[] = [
                'id' => $event->getId(),
                'name' => $event->getName(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'color' => $event->getColor(),
                'description' => $event->getDescription(),
                'timed' => $event->isTimed(),
                'danceClasse' => $event->getDanceClasses()->getName(),
            ];
        }
       
        return new JsonResponse($eventArray);
    }
}
