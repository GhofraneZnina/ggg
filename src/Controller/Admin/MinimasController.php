<?php

namespace App\Controller\Admin;

use App\Entity\Minimas;
use App\Form\Admin\MinimasType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class MinimasController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/minimas', name: 'app_admin_minimas_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $minimas = new Minimas() ;
    $form = $this->createForm(MinimasType::class, $minimas);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $data = $request->request->all() ;

       
        

         $this->em->persist($minimas);
         $this->em->flush();

        $this->addFlash('success','minimas successfully created' );

        return $this->redirectToRoute('app_admin_minimas_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new minimas : END 
     
    $minimas = $this->em->getRepository(Minimas::class)->findAll() ;
     return $this->render('admin/Minimas/index.html.twig', [
        'form' => $form->createView(),
        'minimas' => $minimas,
     ]);

       
     } 
     #[Route('/admin/minimas/{id}/edit', name: 'app_admin_minimas_edit')]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }
        $minimas = $this->em->getRepository(Minimas::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(MinimasType::class, $minimas);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $minimas = $form->getData();
            

            $this->em->persist($minimas);
            $this->em->flush();

            $this->addFlash('success', 'minimas successfully updated');

            return $this->redirectToRoute('app_admin_minimas_list');
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',' : Minimas already exists ! ');
        }

        return $this->render('admin/Minimas/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/admin/minimas/{id}/delete', name: 'app_admin_minimas_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $minimasRepository = $this->em->getRepository(Minimas::class);
       
        $minimas =$minimasRepository->find(['id'=>$id]);;
        if (!$minimas) {
            return $this->redirectToRoute('app_admin_minimas_list');
        }

      
        $this->em->remove($minimas);
        $this->em->flush();
        
        
        $this->addFlash('success','minimas successfully deleted ' );
        return $this->redirectToRoute('app_admin_minimas_list');
    }

    // -----------------------------------------------------------------------------------------------------------




















}




?>
