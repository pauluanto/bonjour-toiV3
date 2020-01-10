<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoitureController extends AbstractController
{

    /**
     * @Route("/profiles", name="profiles")
     * @param VoitureRepository $repo
     * @param PaginatorInterface $paginatorInterface
     * @param Request $request
     * @param $pagination
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VoitureRepository $repo, PaginatorInterface $paginatorInterface, Request $request)
    {

        $rechercheVoiture = new RechercheVoiture();

        $form = $this->createForm(RechercheVoitureType::class,$rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1), /*page number*/
            100 /*limit per page*/
        );
        return $this->render('voiture/voitures.html.twig',[
            "voitures" => $voitures,
            "form" => $form->createView(),
            "admin" => false
        ]);
    }
}