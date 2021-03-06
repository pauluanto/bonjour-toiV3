<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Voiture;
use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
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
     * @param VoitureRepository $repo
     * @param PaginatorInterface $paginatorInterface
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VoitureRepository $repo, PaginatorInterface $paginatorInterface, Request $request)
    {
        $rechercheVoiture = new RechercheVoiture();

        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1) /*page number*/,
            100 /*limit per page*/
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
     * @param Voiture|null $voiture
     * @param Request $request
     * @param ObjectManager $om
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function modification(Voiture $voiture = null, Request $request, ObjectManager $om)
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
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/modification.html.twig', [
            "voiture" => $voiture,
            "form" => $form->createView(),
            "user" => true,

        ]);
    }


    /**
     * @Route("/admin/{id}", name="supVoiture", methods="SUP")
     */
    public function suppression(Voiture $voiture, Request $request, ObjectManager $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $voiture->getId(), $request->get("_token"))) {
            $om->remove($voiture);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin");
        }
    }
}
