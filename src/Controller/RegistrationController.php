<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {
        ;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response

    {
    //      if (!$this->getUser()) {
    //       return $this->redirectToRoute('login') ;
    //     }
        $user = new User() ;
        $user->setRoles([User::ROLE_ADMIN])  ;
        $user->setStatus(User::STATUT_ACTIF);

      //  $registrationForm = $this->createForm(UserType::class, $user);
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);
        
        $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $user = $registrationForm->getData();
            $chekUser = $this->em->getRepository(User::class)->findOneByLogin(
                $user->getLogin());
            if($chekUser){
                $this->addFlash('error',$user->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_user_list');
            }
            $password = $registrationForm->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($user, $password);
            $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success','User successfully created' );

            return $this->redirectToRoute('app_admin_user_list') ;
          //  return $this->redirectToRoute('register') ;
        }else if ($registrationForm->isSubmitted() && !$registrationForm->isValid()) {
            $this->addFlash('error','check your data');
        }

     //  return $this->render('admin/user/create.html.twig', [
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }
}
