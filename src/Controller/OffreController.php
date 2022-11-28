<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    #[Route('/offre', name: 'app_offre')]
    public function index(): Response
    {


        return $this->render('offre/index.html.twig', [
            'controller_name' => 'OffreController',
        ]);
    }
    #[Route('/Ajouter_une_offre', name: 'addOffre')]
    public function addOffre(): Response
    {


        return $this->render('offre/addOffre.html.twig', [
            'controller_name' => 'OffreController',
        ]);
    }
}
