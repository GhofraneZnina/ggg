<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class listUser extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        return $this->render('listing/userlist.html.twig', [
            'controller_name' => 'ListUser',
        ]);
    }

    public function showuser(){
        $UserRepository = $this->getDoctrine()->getRepository(user::class);
             $donnees = $UserRepository->findAll();
            return view('listing/userlist.html.twig',['donnees'=>$user]);
         }
}
?>