<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request): Response
    {

        $form = getData();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$search_email){
                $password = $encoder->encodePassword($user,$user->getPassword());
                $user->setPassword($password);

                $this->entityManager->persist($user);
                $this->entityManager->flush();

//                $content = "Bonjour ".$user->getprenom()."<br>Bienvenue sur la boutique du plaisir gustative.<br><br/>";



                $this->addFlash('notice','Votre compte à bien été enregistrer, un mail vous sera envoyer.');
                return $this->redirectToRoute('app_login');
            }else{
                $this->addFlash('noticeFalse',"Cette Email existe déjà !");
//                $notification = 'Cette Email existe déjà ';
            }


        }





        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

}
