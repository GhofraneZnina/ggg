<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class listEntraineur extends AbstractController
{
    #[Route('/list_entraineur', name: 'list_entraineur')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        return $this->render('listing/entraineurlist.html.twig', [
            'controller_name' => 'listEntraineur',
        ]);
    }
}
?>