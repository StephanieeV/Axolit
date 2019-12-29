<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/monprofil", name="myprofil")
     */
    public function monprofil()
    {
        return $this->render('default/profil1.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
