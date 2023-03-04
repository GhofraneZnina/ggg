<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NageurController extends AbstractController
{
    #[Route('/nageur', name: 'app_nageur')]
    public function index(): Response
    {
        return $this->render('nageur/index.html.twig', [
            'controller_name' => 'NageurController',
        ]);

















        
    }
}
?>