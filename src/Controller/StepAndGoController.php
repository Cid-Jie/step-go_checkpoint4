<?php

namespace App\Controller;

use App\Entity\DanceClasses;
use App\Entity\DanceTeacher;
use App\Repository\DanceClassesRepository;
use App\Repository\DanceTeacherRepository;
use App\Repository\EventPlanningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/step/classes/{id}', name: 'app_dance_class_show', methods: ['GET'])]
    public function showDanceById(DanceClasses $danceClass, DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/showClass.html.twig', [
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
            'dance_class' => $danceClass,
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
    public function planning(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository, EventPlanningRepository $eventPlanningRepository): Response
    {
        $events = $eventPlanningRepository->findAll();

        $eventArray = [];

        foreach ($events as $event) {
            $eventArray[] = [
                'id' => $event->getId(),
                'daysOfWeek' => $event->getDaysOfWeek(),
                'hoursOfDay' => $event->getHoursOfDay(),
                'description' => $event->getDescription(),
            ];
        }

        $data = json_encode($eventArray);

        return $this->render('step_and_go/planning.html.twig', [
            'data' => $data,
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
            'events' => $eventPlanningRepository->findAll(),
        ]);
    }

    #[Route('/step/rate', name: 'app_dance_rate')]
    public function rate(DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('step_and_go/rate.html.twig', [
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
