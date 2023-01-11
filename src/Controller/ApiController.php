<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\RepeatedEvent;
use App\Repository\EventRepository;
use DateInterval;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * Return all informations planning in json
     *
     * @param EventRepository $eventRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/get-events', name: 'app_get_events')]
    public function index(EventRepository $eventRepository, Request $request): Response
    {
        // On récupère le premier et le dernier jour de la semaine courante
        $firstDay = $request->query->get('start');
        $lastDay = $request->query->get('end');

        // On transforme ces dates en nouvelle date avec une heure pour $lastDay qui se termine à 23:59:59
        $firstDay = new \DateTime($firstDay);
        $lastDay = new \DateTime($lastDay);
        $lastDay->setTime(23,59,59);

        // On récupére tous les événements et événements répétitifs en bdd compris dans la semaine
        $eventsFromDatabase = $eventRepository->findByWeek($firstDay, $lastDay);

        /**
         * On créé un nouveau tableau vide puis on boucle sur tous les événements pour extraire
         * et modifier le comportement sur les événements répétitifs
         */ 
        $calculatedEvents = [];
        foreach ($eventsFromDatabase as $eventFromDatabase) {
            
            $eventTransformed = $eventFromDatabase;

            // Si c'est un événement répétitif, on génère une occurence d'un événement répété
            if($eventFromDatabase instanceof RepeatedEvent) {
                
                // On récupère la date de départ et la date de fin de l'événement
                $repetitionStart = $eventFromDatabase->getStart()->setTime(0, 0);
                $repetitionEnd = $eventFromDatabase->getEnd()->setTime(23, 59);

                $daysFromFirstday = match($eventFromDatabase->getDayOfWeek()) {
                    'monday' => 0,
                    'tuesday' => 1,
                    'wednesday' => 2,
                    'thursday' => 3,
                    'friday' => 4,
                    'saturday' => 5,
                    'sunday' => 6
                };

                $eventNextIterationDay = new \DateTime($request->query->get('start'));
                $dateInterval = new DateInterval("P".$daysFromFirstday."D");
             
                $eventNextIterationDay = date_add($eventNextIterationDay, $dateInterval);
                
                // On vérifie si la prochaine itération peut exister entre la date de début et la date de fin
             
                $eventNextIterationStart = $eventNextIterationDay->setTime($eventFromDatabase->getStartHour(), $eventFromDatabase->getStartMinute());
                $isValidIteration = $eventNextIterationStart > $repetitionStart && $eventNextIterationStart < $repetitionEnd;
                
                $eventTransformed = null;

                if($isValidIteration) {

                    $eventTransformed = new Event();
                    
                    // On extrait les caractéristiques communes aux événements
                    $eventTransformed
                        ->setDanceClasses($eventFromDatabase->getDanceClasses())
                        ->setColor($eventFromDatabase->getColor())
                        ->setDescription($eventFromDatabase->getDescription());
                    
                    // La date de début est générée avant pour vérifier si l'événemnet rentre dans les bonnes conditions
                    // donc on génére juste la date de fin à partir des informations et du créneau
                    $eventNextIterationEnd = new \DateTime($request->query->get('start'));
                    $dateInterval = new DateInterval("P".$daysFromFirstday."D");
                    $eventNextIterationEnd = date_add($eventNextIterationEnd, $dateInterval);
                    $eventNextIterationEnd->setTime($eventFromDatabase->getEndHour(), $eventFromDatabase->getEndMinute());

                    // On extrait les dates et créneau de l'événement
                    $eventTransformed
                        ->setStart($eventNextIterationStart)
                        ->setEnd($eventNextIterationEnd);

                }
            }
            
            // On push l'événement répétitif dans le nouveau tableau crée au début
            if ($eventTransformed !== null) {
                $calculatedEvents[] = $eventTransformed;
            }
        }
        
        $eventArray = [];

        foreach ($calculatedEvents as $event) {
            $eventArray[] = [
                'id' => $event->getId(),
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


