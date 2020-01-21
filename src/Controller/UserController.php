<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @todo offrir la possibilité d'éditer son profil à l'utilisateur :displayEditLik  utiliser app.user
     * @Route("/monprofil", name="monprofil")
     */
    public function monprofil()
    {
        $userProfile = $this->getUser();
        return $this->render('default/profil1.html.twig', [
            'controller_name' => 'UserController',
            'userProfile' => $userProfile,
            'displayEditLink' => true,
            dd($userProfile->getPhotoprofil())

        ]);
    }


    /**
     * @todo si utilisateur pas trouvé : template -> Désolé mais cet utilisateur n'existe pas
     * @Route("/profil/{userName}", name="findUserByUsername")
     */
    public function findUserByUsername($userName)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        // look for a single Product by name
        $user = $repository->findOneBy(['pseudo' => $userName]);

        return $this->render('default/profil1.html.twig', [
            'controller_name' => 'UserController',
            'userProfile' => $user,
        ]);
    }

    /**
     * add levenhtstein & soundex function https://github.com/glanchow/doctrine-fuzzy
     * @Route("/profil/fuzzy/{userName}", name="fuzzySearchUsername_route")
     */
    public function fuzzySearchUsername($userName)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $result = $repository->suggestUserName($userName);
        dd($result);

        
        //s$result = $repository->suggest
    }

        /**
     * add levenhtstein & soundex function https://github.com/glanchow/doctrine-fuzzy
     * @Route("/profil/fuzzyprenom/{userName}", name="fuzzyPrenomSearchUsername_route")
     */
    public function fuzzyprenomSearchUsername($userName)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $result = $repository->suggestPrenom($userName);
        dd($result);

        
        //s$result = $repository->suggest
    }




}
