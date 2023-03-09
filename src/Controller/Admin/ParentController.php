<?php

namespace App\Controller\Admin;

use App\Entity\Parents;
use App\Form\Admin\ParentsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParentController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/parent', name: 'app_admin_parent_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
         return $this->redirectToRoute('login') ;
        }

        $parents = $this->em->getRepository(Parents::class)->findAll() ;

        return $this->render('admin/parent/index.html.twig', [
            'parents' => $parents,
        ]);
    }

    #[Route('/admin/parent/create', name: 'app_admin_parent_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
           return $this->redirectToRoute('login') ;
        }
        $parent = new Parents() ;
        $parent->setRoles([Parents::ROLE_PARENTS])  ;
        $parent->setStatus(Parents::STATUT_ACTIF);

        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parent = $form->getData();
            $chekUser = $this->em->getRepository(Parents::class)->findOneByLogin($parent->getLogin());
            if($chekUser){
                $this->addFlash('error',$parent->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_parent_list');
            }
            $password = $form->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($parent, $password);
            $parent->setPassword($password);

            $this->em->persist($parent);
            $this->em->flush();

            $this->addFlash('success','parent successfully created' );

            return $this->redirectToRoute('app_admin_parent_list') ;
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',$parent->getLogin().' : Login already exists ! ');
        }

        return $this->render('admin/parent/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/admin/parent/{id}/edit', name: 'app_admin_parent_edit')]
     public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
     {
         if (!$this->getUser()) {
             return $this->redirectToRoute('login') ;
         }
         $parent = $this->em->getRepository(Parents::class)->findOneBy(['id'=>$id]);


         $form = $this->createForm(ParentsType::class, $parent);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $parent = $form->getData();
             $chekUser = $this->em->getRepository(Parents::class)->findOneByLogin($parent->getLogin());
             if( $chekUser and $chekUser->getId() !== $parent->getId() ){
                 $this->addFlash('error',$parent->getLogin().' : Login already exists ! ');
                 return $this->redirectToRoute('app_admin_parent_list');
             }
             $password = $form->get('password')->getData();
             if (isset($password)){
                 $password = $userPasswordHasher->hashPassword($parent, $password);
                 $parent->setPassword($password);
            

             $this->em->persist($parent);
             $this->em->flush();

             $this->addFlash('success','parent successfully updated' );

             return $this->redirectToRoute('app_admin_parent_list') ;
         }else if ($form->isSubmitted() && !$form->isValid()) {
             $this->addFlash('error',$parent->getLogin().' : Login already exists ! ');
         }

         return $this->render('admin/parent/edit.html.twig', [
             'form' => $form->createView(),
         ]);
    }

     }
    }
    ?>