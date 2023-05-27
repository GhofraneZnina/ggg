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

        $this->addFlash('success','lieu successfully created' );

        return $this->redirectToRoute('app_admin_lieu_list') ;
    } 
    else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new lieu : END 
     
    $lieu = $this->em->getRepository(LieuEntrainement::class)->findAll() ;
     return $this->render('admin/lieu/index.html.twig', [
        'form' => $form->createView(),
        'lieu' => $lieu,
     ]);

    }


     #[Route('/admin/lieu/{id}/delete', name: 'app_admin_lieu_delete')]
     public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
     {
         
         $user = $this->getUser();
 
         
         $LieuEntrainementRepository = $this->em->getRepository(lieuEntrainement::class);
        
         $lieu =$LieuEntrainementRepository->find(['id'=>$id]);;
         if (!$lieu) {
             return $this->redirectToRoute('app_admin_lieu_list');
         }
 
       
         $this->em->remove($lieu);
         $this->em->flush();
         
         
         $this->addFlash('success','lieu successfully deleted ' );
         return $this->redirectToRoute('app_admin_lieu_list');
     }
 
    







       
     
    }