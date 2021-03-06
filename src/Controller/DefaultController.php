<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Response;
use App\Entity\Annonce;
use App\Entity\User;
use App\Form\UserType;
use App\Form\InscriptionType;
use App\Form\InformationsType;
use App\Form\ContactType;
use App\Form\SignalerType;
use App\Form\AnnonceType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AnnonceRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $em=$this->get('doctrine')->getManager();
        $dernieres_annonces = $em->getRepository(Annonce::class)->findAll();

        return $this->render('default/accueil.html.twig', [
            'dernieres_annonces' => $dernieres_annonces,
        ]);
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(Request $request)
    {
        $em=$this->get('doctrine')->getManager();
        $dernieres_annonces = $em->getRepository(Annonce::class)->findAll();

        return $this->render('default/accueil.html.twig', [
            'dernieres_annonces' => $dernieres_annonces,
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
        if($form->isSubmitted()&& $form->isValid()){
            $annonce->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('./default/annonce/annonce.html.twig', array('form_annonce' => $form->createView()));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('./default/contact.html.twig');
    }

    /**
     * @Route("/favoris", name="favoris_reparateur")
     */
    public function favoris_reparateur(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->get('doctrine')->getManager();
        $favoris_reparateurs = $em->getRepository(Annonce::class)->findAll();
        $favoris_reparateurs = $paginator->paginate($favoris_reparateurs, $request->query->getInt('page', 1), 3);

        return $this->render('default/favoris_reparateur.html.twig', [
            'favoris_reparateurs' => $favoris_reparateurs,
        ]);
    }

    /**
     * @Route("/favoris_annonce", name="favoris_annonce")
     */
    public function favoris_annonce(Request $request, PaginatorInterface $paginator)
    {
        $userr = $this->getUser()->getId();
        $em = $this->get('doctrine')->getManager();
        $favoris_annonces = $em->getRepository(Annonce::class)->findBy(
            ['user' => $userr]
        );
        $favoris_annonces = $paginator->paginate($favoris_annonces, $request->query->getInt('page', 1), 3);


        return $this->render('default/favoris.html.twig', [
            'favoris_annonces' => $favoris_annonces,
        ]);
    }

    /**
     * @Route("/addFavorisAnnonce/id={id}", name="addFavorisAnnonce", methods={"GET"})
     */
    public function addFavorisAnnonce($id)
    {

        $em = $this->get('doctrine')->getManager();
        $favoris_annonce = $em->getRepository(Annonce::class)->find($id);
        // if(!$truc){
        //     throw $this->createNotFoundException('Pas de slot');
        // }
        // $stu = intval($stu);
        $favoris_annonce->addUser($this->getUser());
        $em->flush();
        return $this->redirectToRoute('favoris_annonce');
    }

    /**
     * @Route("/removeFavorisAnnonce/id={id}", name="removeFavorisAnnonce", methods={"GET"})
     */
    public function removeFavorisAnnonce($id){
        
            $em = $this->get('doctrine')->getManager();
            $favoris_annonce= $em->getRepository(Annonce::class)->find($id);
            // if(!$truc){
            //     throw $this->createNotFoundException('Pas de slot');
            // }
            // $stu = intval($stu);
            $favoris_annonce->removeUser($this->getUser());
            $em->flush();
            return $this->redirectToRoute('favoris_annonce');
    }

    /**
     * @Route("/removeAnnonce/id={id}", name="removeAnnonce", methods={"GET"})
     */
    public function removeAnnonce($id){
            $entityManager = $this->getDoctrine()->getManager();
            $annonce= $entityManager->getRepository(Annonce::class)->find($id);
            $entityManager->remove($annonce);
            $entityManager->flush();
            
            return $this->redirectToRoute('mes_annonces');
    }

  /**
     * @Route("/{id}/editAnnonce", name="editAnnonce", methods={"GET","POST"})
     */
    public function editAnnonce(Request $request, Annonce $annonce)
    {
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('default/annonce/annonce_edit.html.twig', [
            'annonce' => $annonce,
            'form_annonce' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/informations", name="informations",methods={"GET","POST"})
     */
    public function informations(Request $request){
    // $user=$this->getUser();
    //     $em=$this->get('doctrine')->getManager();
    //     $info = $em->getRepository(User::class)->find($user);
        
         $form = $this->createForm(InformationsType::class);
        $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $this->getDoctrine()->getManager()->flush();

        //     return $this->redirectToRoute('informations');
        // }
        return $this->render('./default/informations.html.twig', array('form_modif_infos'=>$form->createView()));
        
    }

    /**
     * @Route("/{id}/informations", name="editInformations", methods={"GET","POST"})
     */
    public function editInformations(Request $request, User $user)
    {
        $form = $this->createForm(InformationsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('default/informations.html.twig', [
            'user' => $user,
            'form_modif_infos' => $form->createView(),
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
            $photoFile = $form->get('photoprofil')->getData();
            // this condition is needed because the 'photoprofil' field is not required
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();
                dd("hello");
                // Move the file to the directory where brochures are stored
                try {
                    $photoFile->move(
                        $this->getParameter('public/img/profil'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    throw $this->createNotFoundException('Pas de slot');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setPhotoprofil($newFilename);
                dd($user->getPhotoprofil());
            }

            //$user->setPseudo($form->get('prenom')->getData().$form->get('nom')->getData());
            dd($form->get('prenom')->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('connexiazefazefon');
        }
        dd("yareyare");
        return $this->render('./default/inscription.html.twig', array('form_inscription' => $form->createView()));
    }

    /**
     * @Route("/liste_produits", name="liste_produits")
     */
    public function liste_produits(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->get('doctrine')->getManager();
        $annonces = $em->getRepository(Annonce::class)->findBy(
            ['type_annonce' => '5'],
            ['heure_date_publication' => 'DESC']
        );
        $annonces = $paginator->paginate($annonces, $request->query->getInt('page', 1), 3);
        return $this->render('default/liste_produits.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    /**
     * @Route("/liste_reparation", name="liste_reparation")
     */
    public function liste_reparation(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->get('doctrine')->getManager();
        $annonces = $em->getRepository(Annonce::class)->findBy(
            ['type_annonce' => '6'],
            ['heure_date_publication' => 'DESC']
        );
        $annonces = $paginator->paginate($annonces, $request->query->getInt('page', 1), 3);

        return $this->render('default/liste_reparation.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    public function dernieres_annonce(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $dernieres_annonces = $em->getRepository(Annonce::class)->findBy(
            ['heure_date_publication' => 'DESC']
        );

        return $this->render('default/liste_reparation.html.twig', [
            'dernieres_annonces' => $dernieres_annonces,
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
    public function mes_annonces(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->get('doctrine')->getManager();
        $userr = $this->getUser()->getId();
        $mes_annonces = $em->getRepository(Annonce::class)->findBy(
            ['user' => $userr]
        );
        $mes_annonces = $paginator->paginate($mes_annonces, $request->query->getInt('page', 1), 3);

        return $this->render('default/annonce/mes_annonces.html.twig', [
            'mes_annonces' => $mes_annonces,
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit",methods={"GET"})
     */
    public function produit(Annonce $annonce)
    {
        $form = $this->createForm(SignalerType::class);
        return $this->render('default/produit.html.twig',[
                'annonce' => $annonce,
                'form_signaler' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/profil/{id}", name="profil",methods={"GET"})
     */
    public function profil(User $user,Request $request)
    {    
        $form = $this->createForm(SignalerType::class);
        $em = $this->get('doctrine')->getManager();
        // $userr = $this->getUser()->getId();
        $annonces = $em->getRepository(Annonce::class)->findBy(
            ['user' => $user]
        );
        return $this->render('default/profil_autre.html.twig', [
            'user' => $user,'annoncesUser'=>$annonces,
            'form_signaler' => $form->createView(),
            ]
        );
    }
}
