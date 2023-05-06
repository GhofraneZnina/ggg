<?php

namespace App\Controller\Admin;

use App\Entity\Parents;
use App\Form\Admin\ParentsType;
use App\Form\Admin\ParentssType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


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
            
            //dump($dataTime);
           
            //dd($form->getData());
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
        } else if ($form->isSubmitted() && !$form->isValid()) {
            dump($form);
           dd($form->getData());

            $this->addFlash('error','check your data');
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
            }

            $this->em->persist($parent);
            $this->em->flush();

            $this->addFlash('success','User successfully updated' );

            return $this->redirectToRoute('app_admin_parent_list') ;
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',$parent->getLogin().' : Login already exists ! ');
        }
        return $this->render('admin/Parent/edit.html.twig', [
            'form' => $form->createView(),
        ]);


    }
        #[Route('/admin/parent/{id}/page', name: 'app_admin_parent_page')]
        public function pageParent($id, Request $request, UserPasswordHasherInterface $userPasswordHasher , SluggerInterface $slugger): Response
        { 
            
            // TODO : create new parent : START
           $parent = $this->em->getRepository(Parents::class)->findOneBy(['id'=>$id]);  
           $formEdit = $this->createForm(ParentssType::class, $parent);
           $formEdit->handleRequest($request);
            //TODO : edit parent : START
           
            
            if ($formEdit->isSubmitted() && $formEdit->isValid()) {
                $parent = $formEdit->getData();
                $password = $formEdit->get('password')->getData();
                if (isset($password)) {
                    $password = $userPasswordHasher->hashPassword($parent, $password);
                    $parent->setPassword($password);
                }

                $this->em->persist($parent);
                $this->em->flush();

                $this->addFlash('success', 'password successfully updated');

                return $this->redirectToRoute('app_admin_parent_page', ['id' => $id]);
        }
        else if ($formEdit->isSubmitted() && !$formEdit->isValid()) {
                $this->addFlash('error', $parent->getLogin() . ' : Login already exists ! ');

        }

                
            return $this->render('admin/parent/pageParent.html.twig', [
                'parent' => $parent,
                'formEdit' => $formEdit->createView(), ]);
        

        
            
         }
         
        } 
          // TODO : edit parent : END
                
           
        
        
        
        
        

    
    ?>