<?php

namespace App\Controller;

use App\Form\AnnonceType;
use App\Entity\Annonce;
use App\Entity\Modele; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     */
    public function registerAction(Request $request)
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
     * //@todo proposition Jquery du modele d'appareil
     * //@todo suggérer l'inscription sute  à denyAccessUnlessgranted 
     * @Route("/vendre", name="vendre")
     */
    public function vendre(Request $request)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /*
            //récupération des infos 
            $data = $form->getData();
            $modeleLibelle = $data['modele'];
            $repository = $this->getDoctrine()->getRepository(Modele::class);
            // look for a single Product by its primary key (usually "id")
            $modele = $repository->find($modeleLibelle);
            $annonce->setModele($modele);
            */
            $user = $this->getUser();
            $annonce->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('./default/annonce/vendre.html.twig', array('form_annonce' => $form->createView()));
    }

    /**
     * @Route("/{id}/edit", name="annonce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Annonce $annonce): Response
    {
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mes_annonces');
        }

        return $this->render('./default/annonce/mes_annonces.html.twig', [
            'annonce' => $annonce,
            'form_annonce' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Annonce $annonce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mes_annonces');
    }
}
