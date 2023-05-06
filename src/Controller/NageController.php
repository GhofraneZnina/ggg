<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NageController extends AbstractController
{
    #[Route('/nage', name: 'app_nage')]
    public function index(): Response
    {
        return $this->render('nage/index.html.twig', [
            'controller_name' => 'NageController',
        ]);
    }
}
