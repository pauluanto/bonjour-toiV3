<?php
namespace App\Controller;
use App\Entity\RechercheVoiture;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;



class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     * @param $paginatorInterface
     * @param $request
     * @param $repo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VoitureRepository $repo,PaginatorInterface $paginatorInterface, Request $request)
    {
        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class,$rechercheVoiture);
        $form->handleRequest($request);
        $voitures = $paginatorInterface->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
    );
        return $this->render('global/accueil.html.twig',[
            "voitures" => $voitures,
            "form" => $form->createView(),
            "admin" => false
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     * @param Request $request
     * @param ObjectManager $om
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function inscription(Request $request, ObjectManager $om, UserPasswordEncoderInterface $encoder){
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class,$utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $passwordCrypte = $encoder->encodePassword($utilisateur,$utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $utilisateur->setRoles("ROLE_USER");
            $om->persist($utilisateur);
            $om->flush();
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            return $this->redirectToRoute("accueil");
        }
        return $this->render('global/inscription.html.twig',[
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $util){
        return $this->render('global/login.html.twig',[
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
    }





}