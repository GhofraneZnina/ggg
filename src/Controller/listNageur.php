<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class listNageur extends AbstractController
{
    #[Route('/list_nageur', name: 'list_nageur')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        return $this->render('listing/nageurlist.html.twig', [
            'controller_name' => 'listNageur',
        ]);
    }
}
?>