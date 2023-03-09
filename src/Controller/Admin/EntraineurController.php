<?php

namespace App\Controller\Admin;

use App\Entity\Entraineur;
use App\Form\Admin\EntraineurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class EntraineurController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/entraineur', name: 'app_admin_entraineur_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    $entraineurs = $this->em->getRepository(Entraineur::class)->findAll() ;

         return $this->render('admin/entraineur/index.html.twig', [
             'entraineurs' => $entraineurs,
         ]);
     } 

    #[Route('/admin/entraineur/create', name: 'app_admin_entraineur_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
          return $this->redirectToRoute('login') ;
        }
        $entraineur = new Entraineur() ;
        $entraineur->setRoles([Entraineur::ROLE_ENTRAINEUR])  ;
        $entraineur->setStatus(Entraineur::STATUT_ACTIF);

        $form = $this->createForm(EntraineurType::class, $entraineur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entraineur = $form->getData();
            $chekUser = $this->em->getRepository(Entraineur::class)->findOneByLogin($entraineur->getLogin());
            if($chekUser){
                $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_entraineur_list');
            }
            $password = $form->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($entraineur, $password);
            $entraineur->setPassword($password);

            $this->em->persist($entraineur);
            $this->em->flush();

            $this->addFlash('success','Entraineur successfully created' );

            return $this->redirectToRoute('app_admin_entraineur_list') ;
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
        }

        return $this->render('admin/Entraineur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     #[Route('/admin/entraineur/{id}/edit', name: 'app_admin_entraineur_edit')]
     public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
     {
         if (!$this->getUser()) {
             return $this->redirectToRoute('login') ;
         }
         $entraineur = $this->em->getRepository(Entraineur::class)->findOneBy(['id'=>$id]);


         $form = $this->createForm(EntraineurType::class, $entraineur);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $entraineur = $form->getData();
             $chekUser = $this->em->getRepository(Entraineur::class)->findOneByLogin($entraineur->getLogin());
             if( $chekUser and $chekUser->getId() !== $entraineur->getId() ){
                 $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
                 return $this->redirectToRoute('app_admin_entraineur_list');
             }
             $password = $form->get('password')->getData();
             if (isset($password)){
                 $password = $userPasswordHasher->hashPassword($entraineur, $password);
                 $entraineur->setPassword($password);
             }

             $this->em->persist($entraineur);
             $this->em->flush();

             $this->addFlash('success','User successfully updated' );

             return $this->redirectToRoute('app_admin_entraineur_list') ;
         }else if ($form->isSubmitted() && !$form->isValid()) {
             $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
         }

         return $this->render('admin/Entraineur/edit.html.twig', [
             'form' => $form->createView(),
         ]);
    }
    
    // function setActiveClass(RequestStack $requestStack, $routeName)
    // {
    //     $request = $requestStack->getCurrentRequest();
    //     $route = $request->attributes->get('app_admin_entraineur_list');
    //     if ($route === $routeName) {
    //         return 'active';
    //     }
    //     return '';
    // }


}
?>