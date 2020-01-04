<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/creation", name="creationProfil")
     */
    public function modificationProfil(Voiture $voiture = null, Request $request, ObjectManager $om)
    {
        if (!$voiture) {
            $voiture = new Voiture();
        }

        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($voiture);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("accueil");
        }

        return $this->render('admin/modification.html.twig', [
            "voiture" => $voiture,
            "form" => $form->createView(),
            "user" => true,


        ]);
    }

}
