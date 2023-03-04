<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class listParent extends AbstractController
{
    #[Route('/list_parent', name: 'list_parent')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        return $this->render('listing/parentlist.html.twig', [
            'controller_name' => 'listParent',
        ]);
    }
}
?>