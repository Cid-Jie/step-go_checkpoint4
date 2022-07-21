<?php

namespace App\Controller;

use App\Entity\UserMessage;
use App\Form\UserMessageType;
use App\Repository\UserMessageRepository;
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
    public function new(Request $request, UserMessageRepository $userMessageRepository): Response
    {
        $userMessage = new UserMessage();
        $form = $this->createForm(UserMessageType::class, $userMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userMessageRepository->add($userMessage, true);

            return $this->redirectToRoute('app_user_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_message/new.html.twig', [
            'user_message' => $userMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_message_show', methods: ['GET'])]
    public function show(UserMessage $userMessage): Response
    {
        return $this->render('user_message/show.html.twig', [
            'user_message' => $userMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserMessage $userMessage, UserMessageRepository $userMessageRepository): Response
    {
        $form = $this->createForm(UserMessageType::class, $userMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userMessageRepository->add($userMessage, true);

            return $this->redirectToRoute('app_user_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_message/edit.html.twig', [
            'user_message' => $userMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_message_delete', methods: ['POST'])]
    public function delete(Request $request, UserMessage $userMessage, UserMessageRepository $userMessageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userMessage->getId(), $request->request->get('_token'))) {
            $userMessageRepository->remove($userMessage, true);
        }

        return $this->redirectToRoute('app_user_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
