<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifentraineurController extends AbstractController
{
    #[Route('/modifentraineur', name: 'app_modifentraineur')]
    public function index(): Response
    {
        return $this->render('modifentraineur/index.html.twig', [
            'controller_name' => 'ModifentraineurController',
        ]);
    }
}
