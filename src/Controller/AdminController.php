<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Form\UtilisateurType;
use App\Repository\VoitureRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(VoitureRepository $repo, PaginatorInterface $paginatorInterface, Request $request)
    {
        $rechercheVoiture = new RechercheVoiture();

        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1) /*page number*/,
            40 /*limit per page*/
        );
        return $this->render('voiture/voitures.html.twig', [
            "voitures" => $voitures,
            "form" => $form->createView(),
            "admin" => true,

        ]);
    }

    /**
     * @Route("/admin/creation", name="creationVoiture")
     * @Route("/admin/{id}", name="modifVoiture", methods="GET|POST")
     */
    public function modification(Utilisateur $utilisateur = null, Request $request, ObjectManager $om)
    {
        if (!$utilisateur) {
            $utilisateur = new Utilisateur();
        }

        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($utilisateur);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/modification.html.twig', [
            "voiture" => $utilisateur,
            "form" => $form->createView(),
            "user" => true,

        ]);
    }


    /**
     * @Route("/admin/{id}", name="supVoiture", methods="SUP")
     */
    public function suppression(Utilisateur $utilisateur, Request $request, ObjectManager $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $utilisateur->getId(), $request->get("_token"))) {
            $om->remove($utilisateur);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin");
        }
    }
}
