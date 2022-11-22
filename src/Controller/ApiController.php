<?php

namespace App\Controller;

use App\Entity\EventCalendar;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'app_api_event_edit', methods: ['PUT'])]
    public function majEvent(?EventCalendar $eventCalendar, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupére les données envoyées par fullcalendar
        $data = json_decode($request->getContent());

        if(
            isset($data->title) && !empty($data->title) &&
            isset($data->start) && !empty($data->start) &&
            isset($data->description) && !empty($data->description) &&
            isset($data->backgroundColor) && !empty($data->backgroundColor)
        ){
            //Les données sont complètes
                //On initilaise un code
                $code = 200;

                //On vérifie si l'id existe
                if(!$eventCalendar){
                    // On instancie un nouveau eventCalendar
                    $eventCalendar = new EventCalendar;

                    //On change le code
                    $code = 201; // Created

                    // On hydrate l'object avec les données
                    $eventCalendar->setTitle($data->title);
                    $eventCalendar->setDescription($data->description);
                    $eventCalendar->setStart(new DateTime($data->start));
                    if($data->allDay) {
                        $eventCalendar->setEnd(new DateTime($data->start));
                    }else{
                        $eventCalendar->setEnd(new DateTime($data->end));
                    }
                    $eventCalendar->setDanceClasses($data->danceClasses);
                    $eventCalendar->setIsAllDay($data->isAllDay);
                    $eventCalendar->setBackgroundColor($data->backgroundcolor);

                    dd($eventCalendar);

                    $entityManager = $this->entityManager;
                    $entityManager->persist($eventCalendar);
                    $entityManager->flush();
                    
                    //On retourne un code
                    return new Response('Ok', $code);
                }
        } else {
            //Les données sont incomplètes
            return new Response("Données incomplètes", 404);
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
