<?php

namespace App\Controller\Admin;

use App\Entity\CotisationAnnuelle;
use App\Form\Admin\CotisationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CotisationController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/cotisation', name: 'app_admin_cotisation_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $cotisation = new CotisationAnnuelle() ;
    $form = $this->createForm(CotisationType::class, $cotisation);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

 
         $this->em->persist($cotisation);
         $this->em->flush();

        $this->addFlash('success','cotisation successfully created' );

        return $this->redirectToRoute('app_admin_cotisation_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new cotisation : END 
     
    $cotisation = $this->em->getRepository(CotisationAnnuelle::class)->findAll() ;
     return $this->render('admin/cotisation/index.html.twig', [
        'form' => $form->createView(),
        'cotisation' => $cotisation,
     ]);

       
     } 

    #[Route('/admin/cotisation/{id}/delete', name: 'app_admin_cotisation_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $cotisationRepository = $this->em->getRepository(CotisationAnnuelle::class);
       
        $cotisation =$cotisationRepository->find(['id'=>$id]);;
        if (!$cotisation) {
            return $this->redirectToRoute('app_admin_cotisation_list');
        }

      
        $this->em->remove($cotisation);
        $this->em->flush();
        
        
        $this->addFlash('success','cotisation successfully deleted ' );
        return $this->redirectToRoute('app_admin_cotisation_list');
    }

    // -----------------------------------------------------------------------------------------------------------




















}




?>
