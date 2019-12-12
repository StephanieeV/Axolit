<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
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
    public function annonce()
    {
        return $this->render('default/annonce.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
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
        return $this->render('default/favoris_reparateur.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    
    /**
     * @Route("/favoris_annonce", name="favoris_annonce")
     */
    public function favoris_annonce()
    {
        return $this->render('default/favoris.html.twig', [
            'controller_name' => 'DefaultController',
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
    public function inscription()
    {
        return $this->render('default/inscription.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/liste_produits", name="liste_produits")
     */
    public function liste_produits()
    {
        return $this->render('default/liste_produits.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/liste_reparation", name="liste_reparation")
     */
    public function liste_reparation()
    {
        return $this->render('default/liste_reparation.html.twig', [
            'controller_name' => 'DefaultController',
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
    public function vendre()
    {
        return $this->render('default/vendre.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
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
