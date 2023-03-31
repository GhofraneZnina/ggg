<?php

namespace App\Controller\Admin;

use App\Entity\LieuEntrainement;
use App\Form\Admin\LieuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class LieuEntrainementController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/lieu', name: 'app_admin_lieu_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $lieu = new LieuEntrainement() ;
    $form = $this->createForm(LieuType::class, $lieu);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

 
         $this->em->persist($lieu);
         $this->em->flush();

        $this->addFlash('success','cotisation successfully created' );

        return $this->redirectToRoute('app_admin_cotisation_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new cotisation : END 
     
    $lieu = $this->em->getRepository(LieuEntrainement::class)->findAll() ;
     return $this->render('admin/lieu/index.html.twig', [
        'form' => $form->createView(),
        'lieu' => $lieu,
     ]);

       
     } 
    }