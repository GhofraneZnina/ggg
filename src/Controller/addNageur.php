<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class addNageur extends AbstractController
{
    #[Route('/add_nageur', name: 'add_nageur')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        return $this->render('add/addnageur.html.twig', [
            'controller_name' => 'addNageur',
        ]);
    }
}
?>