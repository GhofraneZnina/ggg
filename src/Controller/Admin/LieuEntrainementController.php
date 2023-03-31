<?php

namespace App\Controlle\Admin;
use App\Entity\LieuEntrainement;
use App\Form\Admin\LieuEntrainementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuEntrainementController extends AbstractController
{


    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/LieuEntrainement', name: 'app_admin_lieuEntrainement_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
         }

         //  TODO : create new group : START
         $lieuEntrainement = new LieuEntrainement() ;
         $form = $this->createForm(LieuEntrainementType::class, $lieuEntrainement);
         $form->handleRequest($request);if ($form->isSubmitted() && $form->isValid()) { 
               $this->em->persist($lieuEntrainement);
               $this->em->flush();
 
              $this->addFlash('success','lieuEntrainement  successfully created' ); 
              return $this->redirectToRoute('app_admin_lieuEntrainement_list') ;
          } else if ($form->isSubmitted() && !$form->isValid()) {
 
           //dd($form->getData());
              $this->addFlash('error','check your data');
           }
         //  TODO : create new group : END 
         $lieuEntrainements = $this->em->getRepository(LieuEntrainement::class)->findAll() ; 
         return $this->render('admin/lieuEntrainement/index.html.twig', [
            'form' => $form->createView(),
             'lieuEntrainements' => $lieuEntrainements,
         ]);













    }
}
