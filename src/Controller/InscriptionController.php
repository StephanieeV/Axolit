<?php

namespace App\Controller;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class InscriptionController extends AbstractController{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function registerAction(Request $request){
        $user = new User();
        $form = $this->createForm(User::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('connexion');
        }
        return $this->render('./default/inscription.html.twig', array('form_inscription'=>$form->createView()));
    }
    
}