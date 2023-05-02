<?php

namespace App\Controller\Admin;
use App\Entity\Presence;
use App\Form\Admin\PresenceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PresenceController extends AbstractController
{



 public function __construct(private EntityManagerInterface $em) {
        ;
    }

   

    #[Route('/admin/presence', name: 'app_admin_presence_list')]
    public function index(): Response
    {
        
        $presence = $this->em->getRepository(Presence::class)->findAll();

        return $this->render('admin/presence/index.html.twig', [
            'presence' => $presence,
        ]);
    }

    #[Route('/admin/presence/create', name: 'app_admin_presence_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
       
        $presence = new Presence() ;
         $form = $this->createForm(PresenceType::class, $presence);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {

              $this->em->persist($presence);
              $this->em->flush();

           $this->addFlash('success','presence successfully created' );

             return $this->redirectToRoute('app_admin_presence_create') ;
         }
          else if ($form->isSubmitted() && !$form->isValid()) {

          //dd($form->getData());
             $this->addFlash('error','check your data');
          }
 
         return $this->render('admin/presence/ceate.html.twig', [
             'form' => $form->createView(),
       ]);
     }





    }
 
    




?>
