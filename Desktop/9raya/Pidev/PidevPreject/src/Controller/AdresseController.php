<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\Adresse1Type;
use App\Repository\AdresseRepository;
use App\Repository\CentreRepository;
use App\Repository\TherapistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adresse')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'app_adresse_index', methods: ['GET'])]
    public function index(AdresseRepository $adresseRepository): Response
    {
        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdresseRepository $adresseRepository,$id,TherapistRepository $TherapistRep ): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(Adresse1Type::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $adresseRepository->save($adresse, true);
            $therapist = $TherapistRep->find($id);
            $therapist->setAdresse($adresse);
            $TherapistRep->save($therapist,true);

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }
    #[Route('/newC/{id}', name: 'app_adresse_newC', methods: ['GET', 'POST'])]
    public function newC(Request $request, AdresseRepository $adresseRepository,$id,CentreRepository $CentreRep ): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(Adresse1Type::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $adresseRepository->save($adresse, true);
            $Centre = $CentreRep->find($id);
            $Centre->setAdresse($adresse);
            $CentreRep->save($Centre,true);

            return $this->redirectToRoute('app_centre_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('adresse/newC.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        $form = $this->createForm(Adresse1Type::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/editC', name: 'app_adresse_editC', methods: ['GET', 'POST'])]
    public function editC(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        $form = $this->createForm(Adresse1Type::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_centre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/editC.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresseRepository->remove($adresse, true);
        }

        return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
