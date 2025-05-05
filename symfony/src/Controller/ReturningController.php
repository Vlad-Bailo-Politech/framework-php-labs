<?php

namespace App\Controller;

use App\Entity\Returning;
use App\Form\ReturningForm;
use App\Repository\BookReturnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/returning')]
final class ReturningController extends AbstractController
{
    #[Route(name: 'app_returning_index', methods: ['GET'])]
    public function index(BookReturnRepository $bookReturnRepository): Response
    {
        return $this->render('returning/index.html.twig', [
            'returnings' => $bookReturnRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_returning_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $returning = new Returning();
        $form = $this->createForm(ReturningForm::class, $returning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($returning);
            $entityManager->flush();

            return $this->redirectToRoute('app_returning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('returning/new.html.twig', [
            'returning' => $returning,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_returning_show', methods: ['GET'])]
    public function show(Returning $returning): Response
    {
        return $this->render('returning/show.html.twig', [
            'returning' => $returning,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_returning_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Returning $returning, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReturningForm::class, $returning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_returning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('returning/edit.html.twig', [
            'returning' => $returning,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_returning_delete', methods: ['POST'])]
    public function delete(Request $request, Returning $returning, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$returning->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($returning);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_returning_index', [], Response::HTTP_SEE_OTHER);
    }
}
