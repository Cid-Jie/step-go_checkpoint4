<?php

namespace App\Controller;

use App\Entity\DanceClasses;
use App\Entity\DanceTeacher;
use App\Repository\DanceClassesRepository;
use App\Repository\DanceTeacherRepository;
use App\Repository\EventCalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StepAndGoController extends AbstractController
{
    #[Route('/', name: 'app_step_and_go')]
    public function index(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/index.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll()
        ]);
    }

    #[Route('/step/classes', name: 'app_dance_classes')]
    public function showDance(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/showClasses.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll()
        ]);
    }

    #[Route('/step/classes/{id}', name: 'app_dance_class_show', methods: ['GET'])]
    public function showDanceById(DanceClasses $danceClass, DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/showClass.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
            'dance_class' => $danceClass,
        ]);
    }

    #[Route('/step/teachers', name: 'app_dance_teachers')]
    public function showTeacher(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/showTeachers.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll()
        ]);
    }

    #[Route('/step/teachers/{id}', name: 'app_dance_teacher_show', methods: ['GET'])]
    public function showTeacherById(DanceTeacher $danceTeacher, DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/showTeacher.html.twig', [
            'dance_teachers' => $danceTeacherRepository->findAll(),
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teacher' => $danceTeacher,
        ]);
    }

    #[Route('/step/planning', name: 'app_dance_planning')]
    public function planning(DanceTeacherRepository $danceTeacherRepository, DanceClassesRepository $danceClassesRepository, EventCalendarRepository $eventCalendarRepository): Response
    {
        $events = $eventCalendarRepository->findAll();
        $eventsArray = [];
        foreach($events as $event) {
            $eventsArray[] = [
                'id' => $event->getId(),
                'dance_classes_id' => $event->getDanceClasses(),
                'title' => $event->getTitle(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'is_all_day' => $event->isAllday(),
                'description' => $event->getDescription(),
                'background_color' => $event->getBackgroundColor(),
            ];
        }

        $data = json_encode($eventsArray);
        return $this->render('step_and_go/planning.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
            'data' => $data,
            'events' => $eventCalendarRepository->findAll(),
        ]);
    }

    #[Route('/step/information', name: 'app_dance_information')]
    public function information(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/information.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
        ]);
    }

    #[Route('/step/contact', name: 'app_dance_contact')]
    public function contact(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/contact.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
        ]);
    }
}
