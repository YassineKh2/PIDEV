<?php

namespace App\Controller;

use App\Entity\Therapist;
use App\Form\Therapist1Type;
use App\Repository\TherapistRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/therapist')]
class TherapistController extends AbstractController
{
    #[Route('/', name: 'app_therapist_index', methods: ['GET'])]
    public function index(TherapistRepository $therapistRepository): Response
    {
        return $this->render('therapist/index.html.twig', [
            'therapists' => $therapistRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_therapist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TherapistRepository $therapistRepository,$id,UtilisateurRepository $User): Response
    {
        $therapist = new Therapist();
        $therapist->setIdUtilisateur($User->find($id));
        $form = $this->createForm(Therapist1Type::class, $therapist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('ImageTherapist')->getData();
            $pictureFileCv = $form->get('ImageCvTherapist')->getData();
            if ($pictureFile) {
                $pictureFileName = uniqid() . '.' . $pictureFile->guessExtension();
                $pictureFile->move(
                    $this->getParameter('pictures_directory_user'),
                    $pictureFileName
                );
                $pictureFileName = 'Back/images/user/' . $pictureFileName;
                $therapist->setImageTherapist($pictureFileName);
            }
            else
                $therapist->setImageTherapist("Back/images/user/NoImageFound.png");

            if ($pictureFileCv) {
                $pictureFileName = uniqid() . '.' . $pictureFileCv->guessExtension();
                $pictureFileCv->move(
                    $this->getParameter('pictures_directory_user'),
                    $pictureFileName
                );
                $pictureFileName = 'Back/images/user/' . $pictureFileName;
                $therapist->setImageCvTherapist($pictureFileName);
            }
            else
                $therapist->setImagecvTherapist("Back/images/user/NoImageFound.png");

            $therapistRepository->save($therapist, true);

            return $this->redirectToRoute('app_adresse_new', [
                'id'=>$therapist->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('therapist/new.html.twig', [
            'therapist' => $therapist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_therapist_show', methods: ['GET'])]
    public function show(Therapist $therapist): Response
    {
        return $this->render('therapist/show.html.twig', [
            'therapist' => $therapist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_therapist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Therapist $therapist, TherapistRepository $therapistRepository): Response
    {
        $form = $this->createForm(Therapist1Type::class, $therapist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $therapistRepository->save($therapist, true);

            return $this->redirectToRoute('app_therapist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('therapist/edit.html.twig', [
            'therapist' => $therapist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_therapist_delete', methods: ['POST'])]
    public function delete(Request $request, Therapist $therapist, TherapistRepository $therapistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$therapist->getId(), $request->request->get('_token'))) {
            $therapistRepository->remove($therapist, true);
        }

        return $this->redirectToRoute('app_therapist_index', [], Response::HTTP_SEE_OTHER);
    }
}
