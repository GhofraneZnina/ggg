<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComeptitionController extends AbstractController
{
    #[Route('/comeptition', name: 'app_comeptition')]
    public function index(): Response
    {
        return $this->render('comeptition/index.html.twig', [
            'controller_name' => 'ComeptitionController',
        ]);
    }
}
