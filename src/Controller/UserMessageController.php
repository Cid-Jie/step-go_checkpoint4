<?php

namespace App\Controller;

use App\Entity\UserMessage;
use App\Form\UserMessageType;
use App\Repository\DanceClassesRepository;
use App\Repository\DanceTeacherRepository;
use App\Repository\UserMessageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/message')]
class UserMessageController extends AbstractController
{
    #[Route('/', name: 'app_user_message_index', methods: ['GET'])]
    public function index(UserMessageRepository $userMessageRepository): Response
    {
        return $this->render('user_message/index.html.twig', [
            'user_messages' => $userMessageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserMessageRepository $userMessageRepository, DanceClassesRepository $danceClassesRepository, DanceTeacherRepository $danceTeacherRepository): Response
    {
        $userMessage = new UserMessage();
        $form = $this->createForm(UserMessageType::class, $userMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            

            $this->addFlash('success', 'Merci, votre message a bien été envoyé, nous vous répondrons rapidement.');

            $userMessageRepository->add($userMessage, true);

            return $this->redirectToRoute('app_step_and_go', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_message/new.html.twig', [
            'user_message' => $userMessage,
            'form' => $form,
            'dance_classes' => $danceClassesRepository->findAll(),
            'dance_teachers' => $danceTeacherRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_user_message_show', methods: ['GET'])]
    public function show(UserMessage $userMessage): Response
    {
        return $this->render('user_message/show.html.twig', [
            'user_message' => $userMessage,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_user_message_delete', methods: ['POST'])]
    public function delete(Request $request, UserMessage $userMessage, UserMessageRepository $userMessageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userMessage->getId(), $request->request->get('_token'))) {
            $userMessageRepository->remove($userMessage, true);
        }

        return $this->redirectToRoute('app_user_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
