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
        // Je récupère le premier et le dernier jour de la semaine courante
        $firstDay = $request->query->get('start');
        $lastDay = $request->query->get('end');
        // Je transforme ces dates en nouvelle date avec une heure pour $lastDay qui se termine à 23:59:59
        $firstDay = new \DateTime($firstDay);
        $lastDay = new \DateTime($lastDay);
        $firstDay->setTime(00,00,01);
        $lastDay->setTime(23,59,59);
        // Je récupére tous les événements (y compris les événements répétitifs) en bdd compris dans la semaine affichée
        $eventsFromDatabase = $eventRepository->findByWeek($firstDay, $lastDay);
        // Je créé un nouveau tableau vide
        // Je boucle sur tous les événements récupérés en bdd pour extraire
        // et modifier le comportement sur les événements répétitifs
        $calculatedEvents = [];
        foreach ($eventsFromDatabase as $eventFromDatabase) {
            // J'associe l'événement de la base de données à une nouvelle variable qui comprendra les informations modifiées
            $eventTransformed = $eventFromDatabase;
            // Si c'est un événement répétitif, on génère une occurence d'un événement répété
            if($eventFromDatabase instanceof RepeatedEvent) {
                // Je récupère la date de départ et la date de fin de l'événement auquel j'ajoute des horaires
                $repetitionStart = $eventFromDatabase->getStart()->setTime(0, 0);
                $repetitionEnd = $eventFromDatabase->getEnd()->setTime(23, 59);
                // Je match le jour de la semaine de l'événement
                $daysFromFirstday = match($eventFromDatabase->getDayOfWeek()) {
                    'monday' => 0,
                    'tuesday' => 1,
                    'wednesday' => 2,
                    'thursday' => 3,
                    'friday' => 4,
                    'saturday' => 5,
                    'sunday' => 6
                };
                // J'instancie une nouvelle date pour connaître la prochaine itération de l'événement répétitif
                // L'information d'un objet de la classe DateInterval est une instruction pour aller d'une date/moment à une autre date/moment
                // Le date_add modifie un objet DateTime, avec le nombre de jours récupéré dans le match
                // J'attribue la date de départ et le créneau horaire
                $eventNextIterationDay = new \DateTime($request->query->get('start'));
                $dateInterval = new DateInterval("P".$daysFromFirstday."D");
                $eventNextIterationDay = date_add($eventNextIterationDay, $dateInterval);
                $eventNextIterationStart = $eventNextIterationDay->setTime($eventFromDatabase->getStartHour(), $eventFromDatabase->getStartMinute());
                // Je vérifie que la prochaine itération existe bien, si c'est le cas je crée un nouvel événement
                $isValidIteration = $eventNextIterationStart > $repetitionStart && $eventNextIterationStart < $repetitionEnd;
                $eventTransformed = null;
                if($isValidIteration) {
                    $eventTransformed = new Event();
                    // J'extrait les caractéristiques communes aux événements
                    $eventTransformed
                        ->setDanceClasses($eventFromDatabase->getDanceClasses())
                        ->setColor($eventFromDatabase->getColor())
                        ->setDescription($eventFromDatabase->getDescription());
                    // La date de début est générée avant pour vérifier si l'événemnet rentre dans les bonnes conditions
                    // donc je génére juste la date de fin à partir des informations et du créneau de la même manière
                    $eventNextIterationEnd = new \DateTime($request->query->get('start'));
                    $dateInterval = new DateInterval("P".$daysFromFirstday."D");
                    $eventNextIterationEnd = date_add($eventNextIterationEnd, $dateInterval);
                    $eventNextIterationEnd->setTime($eventFromDatabase->getEndHour(), $eventFromDatabase->getEndMinute());
                    // J'extrait les dates et créneau de l'événement
                    $eventTransformed
                        ->setStart($eventNextIterationStart)
                        ->setEnd($eventNextIterationEnd);
                }
            }
            // Je vérifie que mon événement répétitif n'est pas null et si c'est le cas, 
            // je push l'événement répétitif dans le nouveau tableau crée au début
            if ($eventTransformed !== null) {
                $calculatedEvents[] = $eventTransformed;
            }
        }
        $eventArray = [];
        // Je boucle sur le nouveau tableau pour ré-attribuer chaque événement aux informations en base de données et envoyer tous les événements en base de données
        foreach ($calculatedEvents as $event) {
            // dance classs peut être null
            $danceClassName = '';
            if($event->getDanceClasses()) {
                $danceClassName = $event->getDanceClasses()->getName();
            }
            $eventArray[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'color' => $event->getColor(),
                'description' => $event->getDescription(),
                'danceClasse' =>  $danceClassName,
            ];
        }
        return new JsonResponse($eventArray);
    }  
}


