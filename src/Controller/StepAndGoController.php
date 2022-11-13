<?php

namespace App\Controller;

use App\Repository\DanceClassesRepository;
use App\Repository\DanceTeacherRepository;
use App\Repository\EventCalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StepAndGoController extends AbstractController
{
    #[Route('/', name: 'app_step_and_go')]
    public function index(): Response
    {
        return $this->render('step_and_go/index.html.twig');
    }

    #[Route('/step/classes', name: 'app_dance_classes')]
    public function showDance(DanceClassesRepository $danceClassesRepository): Response
    {
        $danceClasses = $danceClassesRepository->findAll();
        return $this->render('step_and_go/showClasses.html.twig', [
            'danceClasses' => $danceClasses,
        ]);
    }

    #[Route('/step/teachers', name: 'app_dance_teachers')]
    public function showTeacher(DanceTeacherRepository $danceTeacherRepository): Response
    {
        $danceTeachers = $danceTeacherRepository->findAll();
        return $this->render('step_and_go/showTeachers.html.twig', [
            'danceTeachers' => $danceTeachers,
        ]);
    }

    #[Route('/step/planning', name: 'app_dance_planning')]
    public function planning(EventCalendarRepository $eventCalendarRepository): Response
    {
        $events = $eventCalendarRepository->findAll();
        
        $eventsArray = [];
        foreach($events as $event) {
            $eventsArray[] = [
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'description' => $event->getDescription(),
                'background_color' => $event->getBackgroundColor(),
                'isAllDay' => $event->isAllDay(),
                'danceClasses' => $event->getDanceClasses(),
            ];
        }
        $data = json_encode($eventsArray);
        return $this->render('step_and_go/planning.html.twig', compact('data'));
    }

    #[Route('/step/contact', name: 'app_dance_contact')]
    public function contact(DanceClassesRepository $danceClassesRepository): Response
    {
        $danceClasses = $danceClassesRepository->findAll();
        return $this->render('step_and_go/contact.html.twig', [
            'danceClasses' => $danceClasses,
        ]);
    }
}
