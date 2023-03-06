<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/users', name: 'app_admin_user_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
          return $this->redirectToRoute('login') ;
        }

        $users = $this->em->getRepository(User::class)->findAll() ;

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/user/create', name: 'app_admin_user_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
          return $this->redirectToRoute('login') ;
        }
        $user = new User() ;
        $user->setRoles([User::ROLE_ADMIN])  ;
        $user->setStatus(User::STATUT_ACTIF);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $chekUser = $this->em->getRepository(User::class)->findOneByLogin($user->getLogin());
            if($chekUser){
                $this->addFlash('error',$user->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_user_list');
            }
            $password = $form->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($user, $password);
            $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success','User successfully created' );

            return $this->redirectToRoute('app_admin_user_list') ;
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',$user->getLogin().' : Login already exists ! ');
        }

        return $this->render('admin/user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/user/{id}/edit', name: 'app_admin_user_edit')]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        $user = $this->em->getRepository(User::class)->findOneBy(['id'=>$id]);


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $chekUser = $this->em->getRepository(User::class)->findOneByLogin($user->getLogin());
            if( $chekUser and $chekUser->getId() !== $user->getId() ){
                $this->addFlash('error',$user->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_user_list');
            }
            $password = $form->get('password')->getData();
            if (isset($password)){
                $password = $userPasswordHasher->hashPassword($user, $password);
                $user->setPassword($password);
            }

            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success','User successfully updated' );

            return $this->redirectToRoute('app_admin_user_list') ;
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',$user->getLogin().' : Login already exists ! ');
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }



}
