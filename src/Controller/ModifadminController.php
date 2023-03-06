<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifadminController extends AbstractController
{
    #[Route('/modifadmin', name: 'app_modifadmin')]
    public function index(): Response
    {
        return $this->render('modifadmin/index.html.twig', [
            'controller_name' => 'ModifadminController',
        ]);
    }
}
