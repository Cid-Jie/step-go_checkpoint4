<?php

namespace App\Controller;

use App\Entity\DanceTeacher;
use App\Form\DanceTeacherType;
use App\Repository\DanceTeacherRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dance/teacher')]
class DanceTeacherController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_dance_teacher_index', methods: ['GET'])]
    public function index(DanceTeacherRepository $danceTeacherRepository): Response
    {
        return $this->render('dance_teacher/index.html.twig', [
            'dance_teachers' => $danceTeacherRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_dance_teacher_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DanceTeacherRepository $danceTeacherRepository): Response
    {
        $danceTeacher = new DanceTeacher();
        $form = $this->createForm(DanceTeacherType::class, $danceTeacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $danceTeacherRepository->add($danceTeacher, true);

            return $this->redirectToRoute('app_dance_teacher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dance_teacher/new.html.twig', [
            'dance_teacher' => $danceTeacher,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_dance_teacher_show', methods: ['GET'])]
    public function show(DanceTeacher $danceTeacher): Response
    {
        return $this->render('dance_teacher/show.html.twig', [
            'dance_teacher' => $danceTeacher,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_dance_teacher_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DanceTeacher $danceTeacher, DanceTeacherRepository $danceTeacherRepository): Response
    {
        $form = $this->createForm(DanceTeacherType::class, $danceTeacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $danceTeacherRepository->add($danceTeacher, true);

            return $this->redirectToRoute('app_dance_teacher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dance_teacher/edit.html.twig', [
            'dance_teacher' => $danceTeacher,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_dance_teacher_delete', methods: ['POST'])]
    public function delete(Request $request, DanceTeacher $danceTeacher, DanceTeacherRepository $danceTeacherRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$danceTeacher->getId(), $request->request->get('_token'))) {
            $danceTeacherRepository->remove($danceTeacher, true);
        }

        return $this->redirectToRoute('app_dance_teacher_index', [], Response::HTTP_SEE_OTHER);
    }
}
