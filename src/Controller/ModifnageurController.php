<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifnageurController extends AbstractController
{
    #[Route('/modifnageur', name: 'app_modifnageur')]
    public function index(): Response
    {
        return $this->render('modifnageur/index.html.twig', [
            'controller_name' => 'ModifnageurController',
        ]);
    }
}
