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

class UserController extends AbstractController
{
    #[Route('/add_user', name: 'add_user')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
    

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_user"]);

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('main');
            // do anything else you need here, like send an email
           // return redirectToRoute()

            // return $userAuthenticator->authenticateUser(
            //     $user,
            //     $authenticator,
            //     $request
            // );
            
        }

        return $this->render('add/addUser.html.twig', [
            'registrationForm' => $form->createView(),
        ]);   
    }

    
    
    



    
// public function getuser(){
//     $user=user::all();
//     return view('listing/userlist.html.twig',['donnees'=>$user]);
// }
//     public function getuserId($id){
//         $user=user::find($id);
//         return view('modifier/modifieruser',['donnees'=>$user]);
//     }
    
//     public function adduser(Request $req){
//         $user=new user();
//         $user->login=$req->login;
//         $user->password=$req->password;
//         $user->nom=$req->nom;
//         $user->prenom=$req->prenom;
//         $user->telephone=$req->telephone;
//         $user->profil_facebook=$req->profil_facebook;
//         $user->email=$req->email;
       
        
//             $user->save();
//             return redirect('listing/userlist.html.twig')->with('message', 'utilisateur bien ajouté');
       
//         }

//     public function deleteuser($id)
// {
//         $user=user::find($id);
//         $user->delete();
//         return redirect('/listing/userlist.html.twig')->with('messagee', 'administrateur supprimé');
// }
//     public function updateuser(Request $req){
//         $user=user::find($req->id);
//         $user->login=$req->login;
//         $user->password=$req->password;
//         $user->nom=$req->nom;
//         $user->prenom=$req->prenom;
//         $user->telephone=$req->telephone;
//         $user->profil_facebook=$req->profil_facebook;
//         $user->email=$req->email;
    
//         $user->save();
//         return redirect('listing/userlist.html.twig')->with('messageee', 'administrateur modifié');
   
//     }




















}
?>