<?php

namespace App\Controller;

use App\Entity\PlanningCentre;
use App\Form\PlanningCentreType;
use App\Repository\PlanningCentreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planningcentre')]
class PlanningCentreController extends AbstractController
{
    #[Route('/', name: 'app_planning_centre_index', methods: ['GET'])]
    public function index(PlanningCentreRepository $planningCentreRepository): Response
    {
        return $this->render('planning_centre/index.html.twig', [
            'planning_centres' => $planningCentreRepository->findAll(),
        ]);
    }
    #[Route('/front', name: 'app_planning_centre_index2', methods: ['GET'])]
    public function index2(PlanningCentreRepository $planningCentreRepository): Response
    {
        return $this->render('planning_centre/PlanningFront.html.twig', [
            'planning_centres' => $planningCentreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_planning_centre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlanningCentreRepository $planningCentreRepository): Response
    {
        $planningCentre = new PlanningCentre();
        $form = $this->createForm(PlanningCentreType::class, $planningCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planningCentreRepository->save($planningCentre, true);

            return $this->redirectToRoute('app_planning_centre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planning_centre/new.html.twig', [
            'planning_centre' => $planningCentre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planning_centre_show', methods: ['GET'])]
    public function show(PlanningCentre $planningCentre): Response
    {
        return $this->render('planning_centre/show.html.twig', [
            'planning_centre' => $planningCentre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planning_centre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlanningCentre $planningCentre, PlanningCentreRepository $planningCentreRepository): Response
    {
        $form = $this->createForm(PlanningCentreType::class, $planningCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planningCentreRepository->save($planningCentre, true);

            return $this->redirectToRoute('app_planning_centre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planning_centre/edit.html.twig', [
            'planning_centre' => $planningCentre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planning_centre_delete', methods: ['POST'])]
    public function delete(Request $request, PlanningCentre $planningCentre, PlanningCentreRepository $planningCentreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningCentre->getId(), $request->request->get('_token'))) {
            $planningCentreRepository->remove($planningCentre, true);
        }

        return $this->redirectToRoute('app_planning_centre_index', [], Response::HTTP_SEE_OTHER);
    }
}
