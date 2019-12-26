<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Entity\User;
use App\Entity\Modele;
use App\Entity\TypeAnnonce;
use App\Entity\TypeAppareil;



use App\Form\UserType;
use App\Form\InscriptionType;
use App\Form\AnnonceType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AnnonceRepository;

//@todo retirer import response 
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends AbstractController
{
    /**
     * Routes
     */

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('default/accueil.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('default/accueil.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render('default/connexion.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/annonce", name="annonce")
     */
    public function annonce(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('./default/annonce.html.twig', array('form_annonce' => $form->createView()));
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('default/contact.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/favoris", name="favoris_reparateur")
     */
    public function favoris_reparateur()
    {
        $em = $this->get('doctrine')->getManager();
        $favoris_reparateurs = $em->getRepository(Annonce::class)->findAll();
        return $this->render('default/favoris_reparateur.html.twig', [
            'favoris_reparateurs' => $favoris_reparateurs,
        ]);
    }

    /**
     * @Route("/favoris_annonce", name="favoris_annonce")
     */
    public function favoris_annonce()
    {
        $em = $this->get('doctrine')->getManager();
        $favoris_annonces = $em->getRepository(Annonce::class)->findAll();
        return $this->render('default/favoris.html.twig', [
            'favoris_annonces' => $favoris_annonces,
        ]);
    }
    /**
     * @Route("/informations", name="informations")
     */
    public function informations()
    {
        return $this->render('default/informations.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request)
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('connexion');
        }
        return $this->render('./default/inscription.html.twig', array('form_inscription' => $form->createView()));
    }
    /**
     * @Route("/liste_produits", name="liste_produits")
     */
    public function liste_produits()
    {
        $em = $this->get('doctrine')->getManager();
        $annonces = $em->getRepository(Annonce::class)->findAll();
        return $this->render('default/liste_produits.html.twig', [
            'annonces' => $annonces,
        ]);
    }
    /**
     * @Route("/liste_reparation", name="liste_reparation")
     */
    public function liste_reparation()
    {
        $em = $this->get('doctrine')->getManager();
        $annonces = $em->getRepository(Annonce::class)->findAll();
        return $this->render('default/liste_reparation.html.twig', [
            'annonces' => $annonces,
        ]);
    }
    /**
     * @Route("/mentions_legales", name="mentions_legales")
     */
    public function mentions()
    {
        return $this->render('default/mentions.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/mes_annonces", name="mes_annonces")
     */
    public function mes_annonces()
    {
        return $this->render('default/mes_annonces.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/produit/produit1", name="produit1")
     */
    public function produit1()
    {
        return $this->render('default/produit1.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/vendre", name="vendre")
     */
    public function vendre(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $magicwizard = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(4);

            $mmodele = $this->getDoctrine()
            ->getRepository(Modele::class)
            ->find(2);

            $typeannonce = $this->getDoctrine()
            ->getRepository(TypeAnnonce::class)
            ->find(2);

            $typeappareil = $this->getDoctrine()
            ->getRepository(TypeAppareil::class)
            ->find(1);
            $annonce->setTypeAppareil($typeappareil);
            $annonce->setTypeAnnonce($typeannonce);
            $annonce->setUser($magicwizard);
            $annonce->setModele($mmodele);





            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }   
        return $this->render('./default/vendre.html.twig', array('form_annonce' => $form->createView()));
    }
    /**
     * @Route("/profil1", name="profil")
     */
    public function profil1()
    {
        return $this->render('default/profil1.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
