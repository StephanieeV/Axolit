<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends AbstractController{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription()
    {
        return $this->render('default/inscription.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function newUser(Request $request){
        $user = new User();
        $user->setEmail();
        $user->setMdp();
        $user->setNom();
        $user->setPrenom(); 
    }
}