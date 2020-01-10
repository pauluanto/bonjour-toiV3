<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use App\Entity\Utilisateur;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{

    /**
     * @Route("/user")
     */
    public function index() {
        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("/users/{id}", name="user_modif", methods="GET|POST")
     */
    public function modificationProfil(Voiture $voiture = null, Request $request, ObjectManager $om)
    {
        if (!$voiture) {
            $voiture = new Voiture();
        }


        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $voiture->setUser($this->getUser());
            $om->persist($voiture);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("accueil");
        }

        return $this->render('user/modification.html.twig', [
            "voiture" => $voiture,
            "form" => $form->createView(),
            "user" => true,


        ]);
    }


    /**
     * @Route("/user/creation", name="creationProfil")
     * @param Voiture|null $voiture
     * @param Request $request
     * @param ObjectManager $om
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function creationProfil(Voiture $voiture = null, Request $request, ObjectManager $om)
    {
        if (!$voiture) {
            $voiture = new Voiture();
        }

        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $voiture->setUser($this->getUser());
            $om->persist($voiture);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("accueil");
        }

        return $this->render('user/modification.html.twig', [
            "voiture" => $voiture,
            "form" => $form->createView(),
            "user" => true,


        ]);
    }

}
