<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * Retourne all informations planning in json
     *
     * @param EventRepository $eventRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/get-events', name: 'app_get_events')]
    public function index(EventRepository $eventRepository, Request $request): Response
    {
        $firstDay = $request->query->get('start');
        $lastDay = $request->query->get('end');

        $firstDay = new \DateTime($firstDay);
        $lastDay = new \DateTime($lastDay);
        $lastDay->setTime(23,59,59);

        $events = $eventRepository->findByWeek($firstDay, $lastDay);
        $eventArray = [];
        foreach ($events as $event) {
            $eventArray[] = [
                'id' => $event->getId(),
                'name' => $event->getName(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'color' => $event->getColor(),
                'description' => $event->getDescription(),
                'danceClasse' => $event->getDanceClasses()->getName(),
            ];
        }
       
        return new JsonResponse($eventArray);
    }
}
