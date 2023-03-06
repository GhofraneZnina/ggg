<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifparentsController extends AbstractController
{
    #[Route('/modifparents', name: 'app_modifparents')]
    public function index(): Response
    {
        return $this->render('modifparents/index.html.twig', [
            'controller_name' => 'ModifparentsController',
        ]);
    }
}
