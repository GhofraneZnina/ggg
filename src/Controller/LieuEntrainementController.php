<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuEntrainementController extends AbstractController
{
    #[Route('/lieu/entrainement', name: 'app_lieu_entrainement')]
    public function index(): Response
    {
        return $this->render('lieu_entrainement/index.html.twig', [
            'controller_name' => 'LieuEntrainementController',
        ]);
    }
}
